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
Route::post('/user/search', 'UserController@search');

// サインアップ
Route::get('/user/signup', 'UserController@signup_form');
Route::post('/user/signup', 'UserController@signup');
// サインイン
Route::get('/user/signin', 'UserController@signin_form');
Route::post('/user/signin', 'UserController@signin');
// サインアウト
Route::get('/user/signout', 'UserController@signout');
// ツイッターログイン
Route::get('/user/signin/twitter', 'UserController@redirectToProvider');
Route::get('/user/signin/twitter/callback', 'UserController@handleProviderCallback');

// プロファイル
Route::get('/user/{id}/profile', 'ProfileController@profile');
Route::get('/user/{id}/profile/edit', 'ProfileController@edit');
Route::post('/user/{id}/profile/edit', 'ProfileController@update');

// フォロー
Route::get('/user/{id}/follow', 'FollowerController@follow');
Route::get('/user/{id}/unfollow', 'FollowerController@unfollow');

// ロケーション
Route::get('/user/{id}/locate', 'LocateController@view_locate');
Route::get('/user/{id}/locate/add_locate', 'LocateController@add_locate_form');
Route::post('/user/{id}/locate/add_locate', 'LocateController@add_locate');
Route::get('/user/{id}/locate/del_locate', 'LocateController@del_locate_form');
Route::post('/user/{id}/locate/del_locate', 'LocateController@remove_locate');

//グッズ
Route::get('/user/{id}/goods', 'GoodsController@goods');
Route::get('/user/{id}/goods/add', 'GoodsController@add');
Route::post('/user/{id}/goods/add', 'GoodsController@create');
Route::get('/user/{id}/goods/{goods_id}/del', 'GoodsController@del');
Route::post('/user/{id}/goods/{goods_id}/del', 'GoodsController@remove');
Route::get('/user/{id}/goods/multi_del', 'GoodsController@multi_del');
Route::post('/user/{id}/goods/multi_del', 'GoodsController@multi_remove');
// サンプル
Route::get('/user/{id}/sample', 'SampleController@sample');
Route::get('/user/{id}/sample/add', 'SampleController@add');
Route::post('/user/{id}/sample/add', 'SampleController@create');
Route::get('/user/{id}/sample/del', 'SampleController@del');
Route::post('/user/{id}/sample/del', 'SampleController@remove');
//ユーザ情報編集
Route::get('/user/{id}/edit/', 'EditController@edit');
Route::post('/user/{id}/edit/', 'EditController@edit');
//ロケーション編集
Route::get('/user/{id}/edit/locate', 'EditController@add_locate_form');
Route::post('/user/{id}/edit/locate', 'EditController@add_locate');
Route::get('/user/{id}/edit/locate/del_locate', 'LocateController@del_locate_form');
Route::post('/user/{id}/edit/locate/del_locate', 'LocateController@remove_locate');
//グッズ
Route::get('/user/{id}/edit/goods', 'EditController@goods');
//グッズ追加
Route::get('/user/{id}/edit/goods/add', 'EditController@add');
Route::post('/user/{id}/edit/goods/add', 'EditController@create');
//グッズ削除
Route::get('/user/{id}/edit/goods/{goods_id}/del', 'EditController@del');
Route::post('/user/{id}/edit/goods/{goods_id}/del', 'EditController@remove');
//サンプル
Route::get('/user/{id}/edit/sample', 'EditController@sample_edit');
Route::get('/user/{id}/edit/sample/add', 'EditController@sample_add');
Route::post('/user/{id}/edit/sample/add', 'EditController@sample_create');
Route::get('/user/{id}/edit/sample/del', 'EditController@sample_del');
Route::post('/user/{id}/edit/sample/del', 'EditController@sample_remove');