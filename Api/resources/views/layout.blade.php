<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>记撸 - @yield('title')</title>

    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="nav">
        <img src="image/logo.png" alt="jilu">
    </div>
    {{--@if (Route::has('login'))--}}
        {{--<div class="top-right links">--}}
            {{--<a href="{{ url('/login') }}">Login</a>--}}
            {{--<a href="{{ url('/register') }}">Register</a>--}}
        {{--</div>--}}
    {{--@endif--}}

    <div class="content">
        @yield('content')
    </div>
</div>

<script src="{{ elixir('js/app.js') }}"></script>
@yield('script')
</body>
</html>
