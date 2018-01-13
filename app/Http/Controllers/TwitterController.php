<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwitterController extends Controller
{
    public function login(){
    // 参考：https://laravel-room.com/twitter-api-with-laravel53
    $sign_in_twitter = true;
    $force_login = false;
    
    // 一度アクセストークンとアクセストークンシークレットを空にする処理
    Twitter::reconfig(['token' => '', 'secret' => '']);
    
    // getRequestTokenメソッドの引数はコールバックURLを指定
    $token = Twitter::getRequestToken(route('twitter.callback'));

    if (isset($token['oauth_token_secret'])) {
        // 認証画面URL取得
        // https://api.twitter.com/oauth/authenticate?oauth_token={リクエストトークン}の形で取得する
        $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);

        // 後で使うのでセッションで保持
        Session::put('oauth_state', 'start');
        Session::put('oauth_request_token', $token['oauth_token']);
        Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

        // 取得した認証画面のURLにリダイレクト
        return Redirect::to($url);
    }

    return Redirect::route('twitter.error');
    }
}
