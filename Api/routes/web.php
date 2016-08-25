<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('events', 'EventController');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::any('/wechat', 'WechatController@serve');

Route::get('/set-wechat-menu', 'WechatController@setMenu');

Route::group(['middleware' => ['wechat.oauth']], function () {
    Route::get('/me', function () {
        $user = session('wechat.oauth_user'); // 拿到授权用户资料
        dd($user);
    });
});

