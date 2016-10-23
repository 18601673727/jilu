@extends('layout')

@section('title', session('wechat.oauth_user')->nickname .'的记录')

@section('content')
    <div class="body">
        <ul class="cbp_tmtimeline">
            @if (!count($data))
                <p>您当前还没有任何记录, 快去记吧!</p>
            @else
                @foreach($data as $row)
                    <li>
                        <time class="cbp_tmtime" datetime="{{ $row->created_at }}"><span>{{ date('Y-m-d', $row->created_at->timestamp) }}</span> <span>{{ date('H:i:s', $row->created_at->timestamp) }}</span></time>
                        <div class="cbp_type">{{ $row->type }}</div>
                        {{--<div class="cbp_tmicon cbp_tmicon-earth cbp_tmicon-phone cbp_tmicon-screen cbp_tmicon-mail"></div>--}}
                        <div class="cbp_tmlabel">
                            <h2>{{ round(($row->ended_at - $row->started_at) / 1000, 1) }} 秒, {{ round($row->score) }} 分</h2>
                            <p>{!! strlen($row->content) ? $row->content : '<i>未填写备注</i>'; !!}</p>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
@endsection
