<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/wechat_user', function () {
    $user = session('wechat.oauth_user'); // 拿到授权用户资料
    dd($user);
});

