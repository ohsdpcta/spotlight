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
Route::get('/user/{id}/sample/multi_del', 'SampleController@multi_del');
Route::post('/user/{id}/sample/multi_del', 'SampleController@multi_remove');

// 以下編集画面のルート-------------------------------------------------------------------------------

// アカウント情報編集
Route::get('/user/{id}/summary/account', 'UserController@edit');
Route::post('/user/{id}/summary/account', 'UserController@update');

// プロフィール編集
Route::get('/user/{id}/summary/profile', 'ProfileController@edit');
Route::post('/user/{id}/summary/profile', 'ProfileController@update');

// ロケーション編集
Route::get('/user/{id}/summary/locate', 'LocateController@edit');
Route::post('/user/{id}/summary/locate', 'LocateController@update');

// グッズ編集
Route::get('/user/{id}/summary/goods', 'GoodsController@summary');//一覧画面

Route::get('/user/{id}/summary/goods/add', 'GoodsController@add');//追加画面
Route::post('/user/{id}/summary/goods/add', 'GoodsController@create');//追加するぜ！

Route::get('/user/{id}/summary/goods/edit', 'GoodsController@edit');//編集画面
Route::post('/user/{id}/summary/goods/update', 'GoodsController@update');//編集するぜ！

Route::get('/user/{id}/summary/goods/delete', 'GoodsController@delete');//削除画面
Route::post('/user/{id}/summary/goods/remove', 'GoodsController@remove');//削除するぜ！

// サンプル編集
Route::get('/user/{id}/summary/sample', 'SampleController@summary');//一覧画面

Route::get('/user/{id}/summary/sample/add', 'SampleController@add');//追加画面
Route::post('/user/{id}/summary/sample/add', 'SampleController@create');//追加するぜ！

Route::get('/user/{id}/summary/sample/edit', 'SampleController@edit');//編集画面
Route::post('/user/{id}/summary/sample/update', 'SampleController@update');//編集するぜ！

Route::get('/user/{id}/summary/sample/delete', 'SampleController@delete');//削除画面
Route::post('/user/{id}/summary/sample/remove', 'SampleController@remove');//削除するぜ！
