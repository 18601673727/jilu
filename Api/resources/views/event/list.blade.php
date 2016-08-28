@extends('layout')

@section('title', session('wechat.oauth_user')->nickname .'的记录')

@section('content')
    <ul class="cbp_tmtimeline">
        @foreach($data as $row)
            <li>
                <time class="cbp_tmtime" datetime="{{ $row->created_at }}"><span>{{ date('Y-m-d', $row->created_at->timestamp) }}</span> <span>{{ date('H:i:s', $row->created_at->timestamp) }}</span></time>
                <div class="cbp_tmicon"></div> {{--cbp_tmicon-earth cbp_tmicon-phone cbp_tmicon-screen cbp_tmicon-mail--}}
                <div class="cbp_tmlabel">
                    <h2>{{ round(($row->ended_at - $row->started_at) / 1000, 1) }} 秒, {{ round($row->score) }} 分</h2>
                    <p>{!! count($row->content) ? $row->content : '<i>备注为空</i>' !!}</p>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
