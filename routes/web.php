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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('twitter/login', 'TwitterController@login')->name('twitter.login');
Route::get('twitter/callback', 'TwitterController@callback')->name('twitter.callback');
Route::get('twitter/logout', 'TwitterController@logout')->name('twitter.logout');
