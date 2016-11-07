@extends('layout')

@section('title', '附近的人')

@section('content')
    <div id="map"></div>
@endsection

@section('script')
    <script src="http://map.qq.com/api/js?v=2.exp&key=DNWBZ-7WLAX-IH44W-7B326-A5TPT-YWBU3"></script>
    <script>
        var center = new qq.maps.LatLng(
            {{ $location->latitude }},
            {{ $location->longitude }}
        );

        var map = new qq.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 16
        });

        var marker = new qq.maps.Marker({
            position: center,
            map: map
        });

//        var icon = new qq.maps.MarkerImage(
{{--            {{ session('wechat.oauth_user')->avatar }}--}}
//        );

//        marker.setIcon(icon);

        marker.setAnimation(qq.maps.MarkerAnimation.DOWN);
    </script>
@endsection
