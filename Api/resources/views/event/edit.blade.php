@extends('layout')

@section('title', substr($data->created_at, 5, 11) .'的记录')

@section('content')
    <div class="nav bg-event">
        {{ round(($data->ended_at - $data->started_at) / 1000, 1) }} 秒
    </div>

    <div class="text-left">
        <div class="weui_cells weui_cells_form">
            <div class="weui_cells_title">个人打分</div>
            <div class="weui_cells weui_cells_radio">
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

            <div class="weui_cells_title">备注</div>
            <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                    <textarea id="content" class="weui_textarea" placeholder="刺激源 / 体会 / 其他" rows="3">{{ $data->content }}</textarea>
                    <div class="weui_textarea_counter">非必填</div>
                </div>
            </div>

            <div class="weui_cells_title">该记录</div>
            <div class="weui_cell weui_cell_switch">
                <div class="weui_cell_hd weui_cell_primary">是否公开</div>
                <div class="weui_cell_ft">
                    <input id="published" class="weui_switch" type="checkbox" @if($data->published) checked="checked"@endif>
                </div>
            </div>
        </div>

        <div class="weui_btn_area">
            <a class="weui_btn weui_btn_primary" href="javascript:" id="submit-button">确定</a>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#submit-button').on('click', function () {
           $.ajax({
               url: '/events/{{ $data->id }}',
               type: 'PUT',
               data: {
                   score: $('#score').rateit('value'),
                   content: $('#content').val(),
                   published: Number($('#published').is(":checked")),
               },
               success: function () {
                   $('#toast').show().find('.weui_toast_content').html('已完成');
                   setTimeout(function () {
                       $('#toast').hide();
                       window.location.href = '/';
                   }, 2000);
               }
           });
        });
    </script>
@endsection
