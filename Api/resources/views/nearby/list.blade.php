@extends('layout')

@section('title', '附近的人')

@section('content')
    <div id="map"></div>
@endsection

@section('script')
    <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="http://map.qq.com/api/js?v=2.exp&key=DNWBZ-7WLAX-IH44W-7B326-A5TPT-YWBU3"></script>
    <script>
        wx.config(<?php echo $js->config(array('openLocation', 'getLocation'), false) ?>);
        setTimeout(function () {
            wx.getLocation({
                type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
                success: function (res) {
                    console.log(res);
                    //var speed = res.speed; // 速度，以米/每秒计
                    //var accuracy = res.accuracy; // 位置精度

                    var center = new qq.maps.LatLng(res.latitude, res.longitude);

                    var map = new qq.maps.Map(document.getElementById('map'), {
                        center: center,
                        zoom: 16
                    });

                    var marker = new qq.maps.Marker({
                        position: center,
                        map: map
                    });

                    marker.setAnimation(qq.maps.MarkerAnimation.DOWN);
                }
            });
        }, 1000)
    </script>
@endsection
