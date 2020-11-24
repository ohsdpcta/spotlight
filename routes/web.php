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

Route::prefix('/user')->group(function(){
    // 検索結果
    Route::get('search', 'UserController@search');
    // サインアップ
    Route::get('signup', 'UserController@signup_form')->middleware('guest');
    Route::post('signup', 'UserController@signup')->middleware('guest');
    // サインイン
    Route::get('signin', 'UserController@signin_form')->middleware('guest')->name('user.signin');
    Route::post('signin', 'UserController@signin')->middleware('guest');
    // サインアウト
    Route::get('signout', 'UserController@signout')->middleware('auth');
    // ツイッターログイン
    Route::get('signin/twitter', 'UserController@redirectToProvider')->middleware('guest');
    Route::get('signin/twitter/callback', 'UserController@handleProviderCallback')->middleware('guest');

    Route::prefix('/{id}')->group(function(){
        // プロフィール
        Route::get('profile', 'ProfileController@index');

        // フォロー
        Route::get('follow', 'FollowerController@follow')->middleware('auth');
        Route::get('unfollow', 'FollowerController@unfollow')->middleware('auth');

        // ロケーション
        Route::get('locate', 'LocateController@index');
        Route::get('locate/add_locate', 'LocateController@add_locate_form')->middleware('auth');
        Route::post('locate/add_locate', 'LocateController@add_locate')->middleware('auth');
        Route::get('locate/del_locate', 'LocateController@del_locate_form')->middleware('auth');
        Route::post('locate/del_locate', 'LocateController@remove_locate')->middleware('auth');

        //グッズ
        Route::get('goods', 'GoodsController@index');
        Route::get('goods/multi_del', 'GoodsController@multi_del')->middleware('auth');
        Route::post('goods/multi_del', 'GoodsController@multi_remove')->middleware('auth');
        // サンプル
        Route::get('sample', 'SampleController@index');
        Route::get('sample/multi_del', 'SampleController@multi_del')->middleware('auth');
        Route::post('sample/multi_del', 'SampleController@multi_remove')->middleware('auth');

        // 投げ銭
        Route::get('tip', 'UserController@tip');

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
            Route::post('locate/delete', 'LocateController@remove')->middleware('auth');

            // グッズ編集
            Route::get('goods', 'GoodsController@summary')->middleware('auth');//一覧画面
            Route::get('goods/add', 'GoodsController@add')->middleware('auth');//追加画面
            Route::post('goods/add', 'GoodsController@create')->middleware('auth');//追加するぜ！
            Route::get('goods/{goods_id}/edit', 'GoodsController@edit')->middleware('auth');//編集画面
            Route::post('goods/{goods_id}/edit', 'GoodsController@update')->middleware('auth');//編集するぜ！
            Route::get('goods/delete', 'GoodsController@delete')->middleware('auth');//削除画面
            Route::post('goods/delete', 'GoodsController@remove')->middleware('auth');//削除するぜ！

            // サンプル編集
            Route::get('sample', 'SampleController@summary')->middleware('auth');//一覧画面
            Route::get('sample/add', 'SampleController@add')->middleware('auth');//追加画面
            Route::post('sample/add', 'SampleController@create')->middleware('auth');//追加するぜ！
            Route::get('sample/edit', 'SampleController@edit')->middleware('auth');//編集画面
            Route::post('sample/edit', 'SampleController@update')->middleware('auth');//編集するぜ！
            Route::get('sample/delete', 'SampleController@delete')->middleware('auth');//削除画面
            Route::post('sample/delete', 'SampleController@remove')->middleware('auth');//削除するぜ！

            // PayPayURL
            Route::get('paypay', 'PaypayController@edit')->middleware('auth');//削除するぜ！
            Route::post('paypay', 'PaypayController@update')->middleware('auth');//削除するぜ！
            Route::post('paypay/delete', 'PaypayController@remove')->middleware('auth');//削除するぜ！
        });
    });
});