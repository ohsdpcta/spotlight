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
//サインアップ
Route::get('/user/signup', 'UserController@signup_form');
Route::post('/user/signup', 'UserController@signup');
//サインイン
Route::get('/user/signin', 'UserController@signin_form');
Route::post('/user/signin', 'UserController@signin');
//プロファイル
Route::get('/user/{id}/profile', 'ProfileController@profile');
//グッズ
Route::get('/user/{id}/goods', 'GoodsController@add');
Route::post('/user/{id}/goods', 'GoodsController@create');
