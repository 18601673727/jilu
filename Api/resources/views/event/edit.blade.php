@extends('layout')

@section('title', substr($data->created_at, 5, 11) .'的记录')

@section('content')
    <div class="header time-summary">
        {{ round(($data->ended_at - $data->started_at) / 1000, 1) }} 秒
    </div>

    <div class="weui-cells__title">个人打分</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div id="score"
                 class="rateit svg"
                 data-rateit-value="{{ round($data->score) }}"
                 data-rateit-resetable="false"
                 data-rateit-starwidth="40"
                 data-rateit-starheight="40"
                 data-rateit-min="0"
                 data-rateit-max="5"
                 data-rateit-step="1"
                 style="padding: 10px 15px;">
            </div>
        </div>
    </div>

    <div class="weui-cells__title">记录</div>
    <div class="weui-cells">
        <div class="weui-cell weui-cell_select weui-cell_select-after">
            <div class="weui-cell__hd">
                <label for="" class="weui-label">类型</label>
            </div>
            <div class="weui-cell__bd">
                <select class="weui-select" id="type">
                    <option value="masturbation" @if ($data->type === 'masturbation') selected @endif>打灰机/磨豆腐</option>
                    <option value="heterosex" @if ($data->type === 'heterosex') selected @endif>啪啪啪</option>
                    <option value="homosex" @if ($data->type === 'homosex') selected @endif>ASS♂WE♂CAN</option>
                </select>
            </div>
        </div>
    </div>

    <div class="weui-cells__title">隐私</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">公开给好友</div>
            <div class="weui-cell__ft">
                <input id="published" class="weui-switch" type="checkbox" @if($data->published) checked="checked"@endif>
            </div>
        </div>
        {{--<div class="weui-cell weui-cell_switch">--}}
            {{--<div class="weui-cell__bd">可用作数据分析源</div>--}}
            {{--<div class="weui-cell__ft">--}}
                {{--<input class="weui-switch" type="checkbox" @if($data->published) checked="checked"@endif>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>

    <div class="weui-cells__title">备注</div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <textarea id="content" class="weui-textarea" placeholder="刺激源 / 体会 / 其他">{{ $data->content }}</textarea>
                <div class="weui-textarea-counter">非必填</div>
            </div>
        </div>
    </div>

    <div class="weui-btn-area">
        <a class="weui-btn weui-btn_primary" href="javascript:" id="submit-button">确定</a>
    </div>
@endsection
@section('script')
    <script>
        $('#submit-button').on('click', function () {
           $.ajax({
               url: '/events/{{ $data->id }}',
               type: 'PUT',
               data: {
                   type: $('#type').val(),
                   score: $('#score').rateit('value'),
                   content: $('#content').val(),
                   published: Number($('#published').is(":checked")),
               },
               success: function () {
                   $('#toast').show().find('.weui_toast_content').html('已完成');
                   setTimeout(function () {
                       $('#toast').hide();
                       window.location.href = '/events';
                   }, 2000);
               }
           });
        });
    </script>
@endsection
