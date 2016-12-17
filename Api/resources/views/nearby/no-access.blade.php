@extends('layout')

@section('title', session('wechat.oauth_user')->nickname .'的记录')

@section('content')
    <div class="body">
        <p>很抱歉，您没有授权我们获取您的位置，该服务不可用，请尝试重新关注公众号，并给予地理位置授权，谢谢！</p>
    </div>
@endsection
