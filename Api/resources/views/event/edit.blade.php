@extends('layout')

@section('title', '新记录')

@section('content')
    <div class="weui_cells_title">表单</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">qq</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" pattern="[0-9]*" placeholder="请输入qq号"/>
            </div>
        </div>
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" placeholder="请输入验证码"/>
            </div>
            <div class="weui_cell_ft">
                <img src="./images/vcode.jpg" />
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">银行卡</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" pattern="[0-9]*" placeholder="请输入银行卡号"/>
            </div>
        </div>
        <div class="weui_cell weui_vcode weui_cell_warn">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" placeholder="请输入验证码"/>
            </div>
            <div class="weui_cell_ft">
                <i class="weui_icon_warn"></i>
                <img src="./images/vcode.jpg" />
            </div>
        </div>
    </div>
    <div class="weui_cells_tips">底部说明文字底部说明文字</div>
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" id="showTooltips">确定</a>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
