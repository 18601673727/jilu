@extends('layout')

@section('title', session('wechat.oauth_user')->nickname .'的记录')

@section('content')
    <div class="text-left">
        <div class="weui_cells_title">我的记录</div>
        <div class="weui_cells">
            @foreach($data as $row)
                <div class="weui_cell">
                    <div class="weui_cell_hd"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC4AAAAuCAMAAABgZ9sFAAAAVFBMVEXx8fHMzMzr6+vn5+fv7+/t7e3d3d2+vr7W1tbHx8eysrKdnZ3p6enk5OTR0dG7u7u3t7ejo6PY2Njh4eHf39/T09PExMSvr6+goKCqqqqnp6e4uLgcLY/OAAAAnklEQVRIx+3RSRLDIAxE0QYhAbGZPNu5/z0zrXHiqiz5W72FqhqtVuuXAl3iOV7iPV/iSsAqZa9BS7YOmMXnNNX4TWGxRMn3R6SxRNgy0bzXOW8EBO8SAClsPdB3psqlvG+Lw7ONXg/pTld52BjgSSkA3PV2OOemjIDcZQWgVvONw60q7sIpR38EnHPSMDQ4MjDjLPozhAkGrVbr/z0ANjAF4AcbXmYAAAAASUVORK5CYII=" alt="" style="width:20px;margin-right:5px;display:block"></div>
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>{{ round(($row->ended_at - $row->started_at) / 1000, 1) }} 秒, {{ round($row->score) }} 分</p>
                    </div>
                    <div class="weui_cell_ft">{{ $row->created_at }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
