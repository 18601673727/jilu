@extends('layout')

@section('title', '附近的人')

@section('content')<div id="map"></div>@endsection

@section('script')
    <script src="http://map.qq.com/api/js?v=2.exp&libraries=convertor&key=DNWBZ-7WLAX-IH44W-7B326-A5TPT-YWBU3"></script>
    <script>
        var mount = document.getElementById('map');

        qq.maps.convertor.translate(new qq.maps.LatLng(
            {{ $mine->latitude }},
            {{ $mine->longitude }}
        ), 1, function(res) {
            var center = res[0];

            var map = new qq.maps.Map(mount, {
                center: center,
                zoom: 16
            });

            var mine = new qq.maps.Marker({
                position: center,
                map: map
            });

            //        var icon = new qq.maps.MarkerImage(
            {{--            {{ session('wechat.oauth_user')->avatar }}--}}
            //        );

            //        mine.setIcon(icon);

            mine.setAnimation(qq.maps.MarkerAnimation.DOWN);
        });
    </script>
@endsection
