@extends('layout')

@section('title', '附近的人')

@section('content')<div id="map"></div>@endsection

@section('script')
    <script src="http://map.qq.com/api/js?v=2.exp&libraries=convertor&key=DNWBZ-7WLAX-IH44W-7B326-A5TPT-YWBU3"></script>
    <script>
        var mount = document.getElementById('map');
        var locations = [];

        @foreach ($locations as $location)
            locations.push(new qq.maps.LatLng({{$location->latitude}}, {{$location->longitude}}));
        @endforeach

        qq.maps.convertor.translate(locations, 1, function(res) {
            var map = new qq.maps.Map(mount, {
                center: res[0], // use my location as map center
                zoom: 16
            });

            for (var i in res) {
                var location = res[i];
                var marker = new qq.maps.Marker({
                    position: location,
                    map: map
                });

                marker.setAnimation(qq.maps.MarkerAnimation.DOWN);
            }

            //        var icon = new qq.maps.MarkerImage(
            {{--            {{ session('wechat.oauth_user')->avatar }}--}}
            //        );
            //        marker.setIcon(icon);
        });
    </script>
@endsection
