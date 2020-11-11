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


Route::get('/', 'UserController@index');
Route::post('/search', 'UserController@search');
// サインアップ
Route::get('/user/signup', 'UserController@signup_form');
Route::post('/user/signup', 'UserController@signup');
// サインイン
Route::get('/user/signin', 'UserController@signin_form');
Route::post('/user/signin', 'UserController@signin');
// サインアウト
Route::get('/user/signout', 'UserController@signout');
// プロファイル
Route::get('/user/{id}/profile', 'ProfileController@profile');
Route::get('/user/{id}/profile/edit', 'ProfileController@edit');
Route::post('/user/{id}/profile/edit', 'ProfileController@update');
// サンプル
Route::get('/user/{id}/sample', 'SampleController@sample');
Route::get('/user/{id}/sample/add', 'SampleController@add');
Route::post('/user/{id}/sample/add', 'SampleController@create');
Route::get('/user/{id}/sample/del', 'SampleController@del');
Route::post('/user/{id}/sample/del', 'SampleController@remove');