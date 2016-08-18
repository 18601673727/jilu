<?php

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
//    return $request->user();
    $user = session('wechat.oauth_user'); // 拿到授权用户资料

    dd($user);
});
