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

//NewsController.phpへのアクセス

Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
});

//ProfileController.phpへのアクセス
Route::group(['prefix' => 'admin'], function() {
    Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
});

//ニュースの新規作成のルート
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('news/create', 'Admin\NewsController@add');
     Route::post('news/create', 'Admin\NewsController@create'); 
});

//プロフィールの新規作成のルート
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
     Route::get('profile/edit', 'Admin\NewsController@update');
     Route::post('profile/create', 'Admin\NewsController@create'); 
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
    Route::post('news/create', 'Admin\NewsController@create')->middleware('auth');
    Route::get('news', 'Admin\NewsController@index')->middleware('auth'); 
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


