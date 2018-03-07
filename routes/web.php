<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// ログイン前画面
Route::get('/', 'RegistrationController@index');

// タイムライン
Route::get('twitter', 'TwitterController@index')->name('twitter.index');

//　ログイン、ログアウト
Route::get('twitter/login', 'TwitterController@login')->name('twitter.login');
Route::get('twitter/logout', 'TwitterController@logout')->name('twitter.logout');

// コールバック
Route::get('twitter/callback', 'TwitterController@callback')->name('twitter.callback');

// ツイートフォーム画面
Route::get('tweet', 'TwitterController@tweet');

// ツイート処理
Route::post('/tweet', 'TwitterController@post')->name('twitter.post');

// ツイート削除処理
Route::post('/tweet/destroy/{id}', 'TwitterController@destroy');

// リスト画面
Route::get('list', 'TwitterController@list')->name('twitter.list');

// フォロー処理
Route::post('/list/follow/{user_id}', 'TwitterController@follow');

// フォロー削除処理
Route::post('/list/unfollow/{user_id}', 'TwitterController@unfollow');

// いいね！処理
Route::post('/tweet/favorite/{id}', 'TwitterController@favorite');

// いいね！削除処理
Route::post('/tweet/unfavorite/{id}', 'TwitterController@unfavorite');

// いいね！api
Route::post('api/fav/{id}', 'TwitterController@apiFavorite');


// フォロー&リツイート処理
Route::post('/list/follow_retweet/', 'TwitterController@followRetweet');