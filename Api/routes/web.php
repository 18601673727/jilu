<?php

Route::any('/wechat', 'WechatController@serve');

Route::get('/set-wechat-menu', 'WechatController@setMenu');

Route::group(['middleware' => ['wechat.oauth']], function () {
    Route::get('/login', function () {
        $wechatUser = session('wechat.oauth_user');

        // Auto register
        $user = App\User::where('wechat_id', $wechatUser->id)->first();

        if (!$user) {
            $user = App\User::create([
                'email' => $wechatUser->email,
                'nickname' => $wechatUser->nickname,
                'avatar' => $wechatUser->avatar,
                'wechat_id' => $wechatUser->original['openid'],
                'gender' => $wechatUser->original['sex'],
                'language' => $wechatUser->original['language'],
                'city' => $wechatUser->original['city'],
                'province' => $wechatUser->original['province'],
                'country' => $wechatUser->original['country'],
            ]);
        }

        // Auto login
        if (!auth()->check()) {
            auth()->login($user);
        }

        return redirect()->intended('/events/create');
    })->name('login');

    // Logout
    Route::get('/logout', function () {
        if (auth()->check()) {
            auth()->logout();
            die('<h1>See you!</h1>');
        } else {
            die('<h1>You haven\'t logged in yet</h1>');
        }
    })->name('logout');

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('events', 'EventController');
        Route::get('nearby', 'NearbyController@index');
    });
});

