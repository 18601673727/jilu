<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>记撸 - @yield('title')</title>

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>
<div class="container">
    {{--@if (Route::has('login'))--}}
        {{--<div class="top-right links">--}}
            {{--<a href="{{ url('/login') }}">Login</a>--}}
            {{--<a href="{{ url('/register') }}">Register</a>--}}
        {{--</div>--}}
    {{--@endif--}}

    @yield('content')

    <div id="toast" style="display: none;">
        <div class="weui_mask_transparent"></div>
        <div class="weui_toast">
            <i class="weui_icon_toast"></i>
            <p class="weui_toast_content"></p>
        </div>
    </div>
</div>

<script src="{{ elixir('js/app.js') }}"></script>
@yield('script')
</body>
</html>
