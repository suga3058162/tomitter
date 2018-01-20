<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Redirect;
use Twitter;

class TwitterAccess extends Model
{
    //twitterログインを行う
    public function login()
    {
        $sign_in_twitter = true;
        $force_login = false;

        // 一度アクセストークンとアクセストークンシークレットを空にする処理
        Twitter::reconfig(['token' => '', 'secret' => '']);

        // リクエストトークンを取得
        $token = Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret'])) {

            // 認証画面URL取得https://api.twitter.com/oauth/authenticate?oauth_token={リクエストトークン}の形で取得する
            $path = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

            // 後で使うのでセッションで保持
            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            // 取得したtwitter認証画面のURLにリダイレクト
            return $path;
        }
        // topページに遷移する
        return '/';
    }

    //アクセストークンを取得する
    public function updateAndSetSeccionAccessToken(Request $request,$user)
    {
        // キャンセルが押されたときの処理
        $is_cancel = key($request->query()) === 'denied' ? true : false;
        if ($is_cancel) {
            return redirect('/campaign/');
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
            if ($request->has('oauth_verifier')) {
                $oauth_verifier = $request->get('oauth_verifier');
            }

            // アクセストークンを取得
            $token = Twitter::getAccessToken($oauth_verifier);
            if (! isset($token['oauth_token_secret'])) {
                return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
            }

            // 認証に成功したユーザーの情報取得
            $credentials = Twitter::getCredentials();

            // 問題ない時の処理
            if (is_object($credentials) && ! isset($credentials->error)) {

                $twitterToken = [
                    'twitter_uid' => $credentials->id,
                    'twitter_raw_info' => serialize($token)
                ];
                $user->update($twitterToken);
                $user->save();

                // sessionに接続情報に保存
                Session::put('access_token', $token);
            }
        }
        return null;
    }

    public function accessByDbTwitterInfo($user){
        Session::put('access_token', unserialize($user['twitter_raw_info']));
        return;
    }

    public function post($tweetPreset,$tweetImagePath)
    {
        $uploaded_media = Twitter::uploadMedia(['media' => File::get($tweetImagePath)]);
        try {
            Twitter::postTweet([
                'status' => $tweetPreset,
                'media_ids' => $uploaded_media->media_id_string
            ]);
        } catch(\Exception $e) {
            Logger($e);
        }
    }
}
