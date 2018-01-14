<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use File;
use Redirect;
use Twitter;
use App\User;

class TwitterController extends Controller
{
    public function login()
    {
        $sign_in_twitter = true;
        $force_login = false;

        // Make sure we make this request w/o tokens, overwrite the default values in case of login.
        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret'])) {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            return Redirect($url);
        }

        return Redirect('twitter.error');
    }

    public function logout()
    {
         Session::forget('access_token');
          return Redirect('');
    }

    public function callback(Request $request)
    {
        // キャンセルが押されたときの処理
        // deniedが必ずパラメータについているのでそれで判断します。
        $is_cancel = key($request->query()) === 'denied' ? true : false;
        if ($is_cancel) {
            return redirect('/');
        }

        // リクエストトークンがセッションに保持されている時
        if (Session::has('oauth_request_token')) {
            // リクエストトークンとシークレットをそれぞれセット
            $request_token = [
                'token'  => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];

            // ttwitter.phpの配列をマージ
            Twitter::reconfig($request_token);
            $oauth_verifier = false;

            // 付与されたパラメータを取得
            if (Input::has('oauth_verifier')) {
                $oauth_verifier = Input::get('oauth_verifier');
            }

            // getAccessToken() will reset the token for you
            // アクセストークンを取得
            // $oauth_verifierが空の場合、うまく連携できていないのでエラーが出力されます
            $token = Twitter::getAccessToken($oauth_verifier);
            if (!isset($token['oauth_token_secret'])) {
                return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
            }
            
            // 認証に成功したユーザーの情報取得
            $credentials = Twitter::getCredentials();

            // 問題ない時の処理
            if (is_object($credentials) && !isset($credentials->error)) {
                // $credentials contains the Twitter user object with all the info about the user.
                // Add here your own user logic, store profiles, create new users on your tables...you name it!
                // Typically you'll want to store at least, user id, name and access tokens
                // if you want to be able to call the API on behalf of your users.

                // This is also the moment to log in your users if you're using Laravel's Auth class
                // Auth::login($user) should do the trick.

                // sessionに接続情報に保存
                Session::put('access_token', $token);

                // nullになった
                // $user = Auth::user();
                // dd($user);

                // usersテーブルへログインユーザー情報を保存
                $user = User::updateOrCreate(
                    ['twitter_uid' => $credentials->id],
                    ['twitter_raw_info' => serialize($token)]
                );
                Auth::login($user);

                $twitterToken = [
                    'twitter_uid' => $credentials->id,
                    'twitter_raw_info' => serialize($token)
                ];
                $user->update($twitterToken);
                $user->save();

                // ログイン後の画面へ遷移
                return Redirect::to('/test1')->with('flash_notice', 'Congrats! You\'ve successfully signed in!');
            }
            // ログイン前の画面へ遷移
            // return Redirect('/twitter/login');
            return Redirect::route('twitter.error')->with('flash_error', 'Crab! Something went wrong while signing you up!');
        }
    }
}
