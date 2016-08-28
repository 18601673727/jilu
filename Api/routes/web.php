<?php

Route::any('/wechat', 'WechatController@serve');

Route::get('/set-wechat-menu', 'WechatController@setMenu');

Route::group(['middleware' => ['wechat.oauth']], function () {
    Route::get('/login', function () {
        // Auto register
        $user = App\User::where('wechat_id', session('wechat.oauth_user')->id)->first();

        if (!$user) {
            $user = App\User::create([
                'wechat_id' => session('wechat.oauth_user')->id,
            ]);
        }

        // Auto login
        if (!auth()->check()) {
            auth()->login($user);
        }

        return redirect()->intended('/events/create');
    })->name('login');

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('events', 'EventController');
    });
});

