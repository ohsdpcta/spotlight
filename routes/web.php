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
if (request()->isSecure()) {
    \URL::forceScheme('https');
}
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
    Route::get('signout', 'UserController@signout')->middleware('verified');
    // Twitterログイン
    Route::get('signin/twitter', 'UserController@redirectToProvider')->middleware('guest');
    Route::get('signin/twitter/callback', 'UserController@handleProviderCallback')->middleware('guest');
    // Googleログイン
    Route::get('signin/google', 'UserController@redirectToProviderGoogle')->middleware('guest');
    Route::get('signin/google/callback', 'UserController@handleProviderCallbackGoogle')->middleware('guest');
    //メール
    Route::get('emails/authentication','UserController@authentication')->middleware('verified');

    Route::prefix('/{id}')->group(function(){
        // フォロー
        Route::get('follow', 'FollowerController@follow')->middleware('verified');
        Route::get('unfollow', 'FollowerController@unfollow')->middleware('verified');
        Route::get('followlist', 'FollowerController@followlist')->middleware('verified');
        Route::get('followerlist', 'FollowerController@followerlist')->middleware('verified');

        // プロフィール
        Route::get('profile', 'ProfileController@index');
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
            Route::get('account', 'UserController@edit')->middleware('verified');
            Route::post('account', 'UserController@update')->middleware('verified');
            Route::get('account/delete', 'UserController@delete')->middleware('verified');
            Route::get('account/remove', 'UserController@remove')->middleware('verified');

            // プロフィール編集
            Route::get('profile', 'ProfileController@edit')->middleware('verified');
            Route::post('profile', 'ProfileController@update')->middleware('verified');

            // ロケーション編集
            Route::get('locate', 'LocateController@edit')->middleware('verified');
            Route::post('locate', 'LocateController@update')->middleware('verified');
            Route::get('locate/delete', 'LocateController@remove')->middleware('verified');

            // グッズ編集
            Route::get('goods', 'GoodsController@summary')->middleware('verified');//一覧画面
            Route::get('goods/add', 'GoodsController@add')->middleware('verified');//追加画面
            Route::post('goods/add', 'GoodsController@create')->middleware('verified');//追加するぜ！
            Route::get('goods/{goods_id}/edit', 'GoodsController@edit')->middleware('verified');//編集画面
            Route::post('goods/{goods_id}/edit', 'GoodsController@update')->middleware('verified');//編集するぜ！
            Route::get('goods/delete', 'GoodsController@delete')->middleware('verified');//削除画面
            Route::post('goods/delete', 'GoodsController@remove')->middleware('verified');//削除するぜ！

            // サンプル編集
            Route::get('sample', 'SampleController@summary')->middleware('verified');//一覧画面
            Route::get('sample/add', 'SampleController@add')->middleware('verified');//追加画面
            Route::post('sample/add', 'SampleController@create')->middleware('verified');//追加するぜ！
            Route::get('sample/{sample_id}/edit', 'SampleController@edit')->middleware('verified');//編集画面
            Route::post('sample/{sample_id}/edit', 'SampleController@update')->middleware('verified');//編集するぜ！
            Route::get('sample/delete', 'SampleController@delete')->middleware('verified');//削除画面
            Route::post('sample/delete', 'SampleController@remove')->middleware('verified');//削除するぜ！

            // PayPayURL
            Route::get('paypay', 'PaypayController@edit')->middleware('verified');//削除するぜ！
            Route::post('paypay', 'PaypayController@update')->middleware('verified');//削除するぜ！
            Route::get('paypay/delete', 'PaypayController@remove')->middleware('verified');//削除するぜ！
        });
    });
});
