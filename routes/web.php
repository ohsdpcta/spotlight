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


Route::get('/home', 'HomeController@index')->name('home');
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
    Route::get('signout', 'UserController@signout')->middleware('Mailvarification');
     // ツイッターログイン
    Route::get('signin/twitter', 'UserController@redirectToProvider')->middleware('guest');
    Route::get('signin/twitter/callback', 'UserController@handleProviderCallback')->middleware('guest');
     //メール
    Route::get('emails/authentication','UserController@authentication')->middleware('Mailvarification');
    Route::post('emails/confirmation','UserController@confirmation')->middleware('Mailvarification');


    Route::prefix('/{id}')->group(function(){
         // プロフィール
        Route::get('profile', 'ProfileController@index');

         // フォロー
        Route::get('follow', 'FollowerController@follow')->middleware('Mailvarification');
        Route::get('unfollow', 'FollowerController@unfollow')->middleware('Mailvarification');
        Route::get('followlist', 'FollowerController@followlist')->middleware('Mailvarification');
        Route::get('followerlist', 'FollowerController@followerlist')->middleware('Mailvarification');

         // ロケーション
        Route::get('locate', 'LocateController@index');
        Route::get('locate/add_locate', 'LocateController@add_locate_form')->middleware('Mailvarification');
        Route::post('locate/add_locate', 'LocateController@add_locate')->middleware('Mailvarification');
        Route::get('locate/del_locate', 'LocateController@del_locate_form')->middleware('Mailvarification');
        Route::post('locate/del_locate', 'LocateController@remove_locate')->middleware('Mailvarification');

         //グッズ
        Route::get('goods', 'GoodsController@index');
        Route::get('goods/multi_del', 'GoodsController@multi_del')->middleware('Mailvarification');
        Route::post('goods/multi_del', 'GoodsController@multi_remove')->middleware('Mailvarification');
         // サンプル
        Route::get('sample', 'SampleController@index');
        Route::get('sample/multi_del', 'SampleController@multi_del')->middleware('Mailvarification');
        Route::post('sample/multi_del', 'SampleController@multi_remove')->middleware('Mailvarification');

         // 投げ銭
        Route::get('tip', 'UserController@tip');


 // 以下編集画面のルート-------------------------------------------------------------------------------

        Route::prefix('/summary')->group(function(){
             // アカウント情報編集
            Route::get('account', 'UserController@edit')->middleware('Mailvarification');
            Route::post('account', 'UserController@update')->middleware('Mailvarification');
            Route::get('account/delete', 'UserController@delete')->middleware('Mailvarification');
            Route::post('account/delete', 'UserController@remove')->middleware('Mailvarification');

             // プロフィール編集
            Route::get('profile', 'ProfileController@edit')->middleware('Mailvarification');
            Route::post('profile', 'ProfileController@update')->middleware('Mailvarification');

             // ロケーション編集
            Route::get('locate', 'LocateController@edit')->middleware('Mailvarification');
            Route::post('locate', 'LocateController@update')->middleware('Mailvarification');
            Route::post('locate/delete', 'LocateController@remove')->middleware('Mailvarification');

             // グッズ編集
            Route::get('goods', 'GoodsController@summary')->middleware('Mailvarification');//一覧画面
            Route::get('goods/add', 'GoodsController@add')->middleware('Mailvarification');//追加画面
            Route::post('goods/add', 'GoodsController@create')->middleware('Mailvarification');//追加するぜ！
            Route::get('goods/{goods_id}/edit', 'GoodsController@edit')->middleware('Mailvarification');//編集画面
            Route::post('goods/{goods_id}/edit', 'GoodsController@update')->middleware('Mailvarification');//編集するぜ！
            Route::get('goods/delete', 'GoodsController@delete')->middleware('Mailvarification');//削除画面
            Route::post('goods/delete', 'GoodsController@remove')->middleware('Mailvarification');//削除するぜ！

             // サンプル編集
            Route::get('sample', 'SampleController@summary')->middleware('Mailvarification');//一覧画面
            Route::get('sample/add', 'SampleController@add')->middleware('Mailvarification');//追加画面
            Route::post('sample/add', 'SampleController@create')->middleware('Mailvarification');//追加するぜ！
            Route::get('sample/{sample_id}/edit', 'SampleController@edit')->middleware('Mailvarification');//編集画面
            Route::post('sample/{sample_id}/edit', 'SampleController@update')->middleware('Mailvarification');//編集するぜ！
            Route::get('sample/delete', 'SampleController@delete')->middleware('Mailvarification');//削除画面
            Route::post('sample/delete', 'SampleController@remove')->middleware('Mailvarification');//削除するぜ！

             // PayPayURL
            Route::get('paypay', 'PaypayController@edit')->middleware('Mailvarification');//削除するぜ！
            Route::post('paypay', 'PaypayController@update')->middleware('Mailvarification');//削除するぜ！
            Route::post('paypay/delete', 'PaypayController@remove')->middleware('Mailvarification');//削除するぜ！
        });
    });
});
