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

Auth::routes(['verify' => true]);
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
    Route::get('signout', 'UserController@signout')->middleware('auth');
    // Twitterログイン
    Route::get('signin/twitter', 'UserController@redirectToProvider')->middleware('guest');
    Route::get('signin/twitter/callback', 'UserController@handleProviderCallback')->middleware('guest');
    // Googleログイン
    Route::get('signin/google', 'UserController@redirectToProviderGoogle')->middleware('guest');
    Route::get('signin/google/callback', 'UserController@handleProviderCallbackGoogle')->middleware('guest');
    //メール
    Route::get('emails/conteact','UserController@conteact')->middleware('auth');
    Route::get('emails/authentication/{token}','UserController@authentication')->middleware('auth');
    Route::post('emails/confirmation','UserController@confirmation')->middleware('auth');




    Route::prefix('/{id}')->group(function(){
         // プロフィール
        Route::get('profile', 'ProfileController@index');

         // フォロー
        Route::get('follow', 'FollowerController@follow')->middleware('Mailvarification');
        Route::get('unfollow', 'FollowerController@unfollow')->middleware('Mailvarification');
        Route::get('followlist', 'FollowerController@followlist');
        Route::get('followerlist', 'FollowerController@followerlist');

         // ロケーション
        Route::get('locate', 'LocateController@index');
         //グッズ
        Route::get('goods', 'GoodsController@index');
         // サンプル
        Route::get('sample', 'SampleController@index');
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
            Route::get('locate/delete', 'LocateController@remove')->middleware('Mailvarification');

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
            Route::get('paypay/delete', 'PaypayController@remove')->middleware('Mailvarification');//削除するぜ！

            //タグ編集
            Route::get('tag', 'TagController@summary')->middleware('Mailvarification');
            Route::get('tag/add', 'TagController@add')->middleware('Mailvarification');
            Route::post('tag/add', 'TagController@create')->middleware('Mailvarification');
            Route::get('tag/delete', 'TagController@delete')->middleware('Mailvarification');
            Route::post('tag/delete', 'TagController@remove')->middleware('Mailvarification');

            //　一言コメント
            Route::get('smallprofile', 'SmallProfileController@edit')->middleware('Mailvarification');
            Route::post('smallprofile', 'SmallProfileController@update')->middleware('Mailvarification');//追加するぜ
            Route::get('smallprofile/delete', 'SmallProfileController@remove')->middleware('Mailvarification');//削除するぜ！

            //パスワード変更メール送信
            Route::get('change','UserController@change')->middleware('Mailvarification');//送信ページ
            Route::post('change/changemail','UserController@changemail')->middleware('Mailvarification');//メール本文
            Route::get('changeedit/{token}','UserController@changeedit')->middleware('Mailvarification');//変更ページ
            Route::post('changeedit/changeupdate','UserController@changeupdate')->middleware('Mailvarification');//変更処理
            //ソーシャルID変更メール機能
            Route::get('social_change','UserController@social_change')->middleware('Mailvarification');//送信ページ
            Route::post('social_change/socialemail','UserController@socialemail')->middleware('Mailvarification');//メール本文
            Route::get('socialedit/{token}','UserController@socialedit')->middleware('Mailvarification');//変更ページ
            Route::post('socialedit/socialupdate','UserController@socialupdate')->middleware('Mailvarification');//変更処理
            //メールアドレス変更機能
            Route::get('mail_change','UserController@mail_change')->middleware('Mailvarification');//送信ページ
            Route::post('mail_change/mail_email','UserController@mail_email')->middleware('Mailvarification');//メール本文
            Route::get('mailedit/{token}','UserController@mailedit')->middleware('Mailvarification');//変更ページ
            Route::post('mailedit/mailupdate','UserController@mailupdate')->middleware('Mailvarification');//変更処理

        });
    });
});
