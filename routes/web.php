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

Route::get('/', 'RegistrationController@index');

//タイムラインの表示
Route::get('twitter', 'TwitterController@index')->name('twitter.index');

Route::get('twitter/login', 'TwitterController@login')->name('twitter.login');
Route::get('twitter/callback', 'TwitterController@callback')->name('twitter.callback');
Route::get('twitter/logout', 'TwitterController@logout')->name('twitter.logout');

// ツイートする画面
Route::get('tweet', 'TwitterController@tweet');
// ツイート処理
Route::post('/tweet', 'TwitterController@post')->name('twitter.post');
// ツイート削除処理
Route::post('/tweet/destroy/{id}', 'TwitterController@destroy');

// リスト画面
Route::get('list', 'TwitterController@list')->name('twitter.list');

// フォロー処理
Route::post('/list/follow/{user_id}', 'TwitterController@follow');

// フォロー処理
Route::post('/list/unfollow/{user_id}', 'TwitterController@unfollow');