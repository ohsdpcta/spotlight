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
Route::get('/user/search', 'UserController@search');

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
Route::get('/user/{id}/goods/multi_del', 'GoodsController@multi_del');
Route::post('/user/{id}/goods/multi_del', 'GoodsController@multi_remove');
// サンプル
Route::get('/user/{id}/sample', 'SampleController@sample');
Route::get('/user/{id}/sample/multi_del', 'SampleController@multi_del');
Route::post('/user/{id}/sample/multi_del', 'SampleController@multi_remove');

// 以下編集画面のルート-------------------------------------------------------------------------------

        Route::prefix('/summary')->group(function(){
            // アカウント情報編集
            Route::get('account', 'UserController@edit')->middleware('auth');
            Route::post('account', 'UserController@update')->middleware('auth');

            // プロフィール編集
            Route::get('profile', 'ProfileController@edit')->middleware('auth');
            Route::post('profile', 'ProfileController@update')->middleware('auth');

            // ロケーション編集
            Route::get('locate', 'LocateController@edit')->middleware('auth');
            Route::post('locate', 'LocateController@update')->middleware('auth');
            Route::post('locate/remove', 'LocateController@remove')->middleware('auth');

            // グッズ編集
            Route::get('goods', 'GoodsController@summary')->middleware('auth');//一覧画面

            Route::get('goods/add', 'GoodsController@add')->middleware('auth');//追加画面
            Route::post('goods/add', 'GoodsController@create')->middleware('auth');//追加するぜ！

            Route::get('goods/edit', 'GoodsController@edit')->middleware('auth');//編集画面
            Route::post('goods/update', 'GoodsController@update')->middleware('auth');//編集するぜ！

            Route::get('goods/delete', 'GoodsController@delete')->middleware('auth');//削除画面
            Route::post('goods/remove', 'GoodsController@remove')->middleware('auth');//削除するぜ！

            // サンプル編集
            Route::get('sample', 'SampleController@summary')->middleware('auth');//一覧画面

            Route::get('sample/add', 'SampleController@add')->middleware('auth');//追加画面
            Route::post('sample/add', 'SampleController@create')->middleware('auth');//追加するぜ！

            Route::get('sample/edit', 'SampleController@edit')->middleware('auth');//編集画面
            Route::post('sample/update', 'SampleController@update')->middleware('auth');//編集するぜ！

            Route::get('sample/delete', 'SampleController@delete')->middleware('auth');//削除画面
            Route::post('sample/remove', 'SampleController@remove')->middleware('auth');//削除するぜ！
        });
    });
});