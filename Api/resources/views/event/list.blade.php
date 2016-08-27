@extends('layout')

@section('title', session('wechat.oauth_user')->nickname .'的记录')

@section('content')
    <div class="text-left">
        <ul>
            @foreach($data as $row)
                <li>
                    {{ round(($row->ended_at - $row->started_at) / 1000, 1) }} 秒
                    <br>{{ round($row->score) }}
                </li>
            @endforeach
        </ul>
    </div>
@endsection
