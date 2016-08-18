<?php

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/set-wechat-menu', 'WechatController@setMenu');
