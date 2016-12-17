@extends('layout')

@section('title', '附近的人')

@section('content')<div id="map"></div>@endsection

@section('script')
    <script src="http://map.qq.com/api/js?v=2.exp&libraries=convertor&key=DNWBZ-7WLAX-IH44W-7B326-A5TPT-YWBU3"></script>
    <script>
        (function (window, $) {
            var mount = document.getElementById('map');
            var locations = [];
            var users = {
                avatars: [],
                nicknames: [],
                distances: [],
                anchors: [],
            };

            @foreach ($locations as $location)
                users.avatars.push('{{$location->avatar}}');
                users.nicknames.push('{{$location->nickname}}');

                @if (!$location->distance)
                    users.distances.push("");
                @elseif ($location->distance < 0.1)
                    users.distances.push("一百米以内");
                @elseif ($location->distance < 1)
                    users.distances.push("一公里以内");
                @elseif ($location->distance < 10)
                    users.distances.push("十公里以内");
                @else
                    users.distances.push("五十公里以内");
                @endif

                users.anchors.push('{{ $location->gender ? '/image/male.png' : '/image/female.png' }}');

                locations.push(new qq.maps.LatLng({{$location->latitude}}, {{$location->longitude}}));
            @endforeach

            qq.maps.convertor.translate(locations, 1, function(res) {
                var map = null;

                $.each(res, function (i, position) {
                    if (i === 0) {
                        // use "my" location as map center
                        map = new qq.maps.Map(mount, {
                            center: position,
                            zoom: 16
                        });
                    }

                    var marker = new qq.maps.Marker({
                        position: position,
                        map: map,
                    });

                    marker.setIcon(new qq.maps.MarkerImage(
                        users.anchors[i],
                        null, null, null,
                        new qq.maps.Size(30, 30)
                    ));

                    marker.setAnimation(qq.maps.MarkerAnimation.DROP);

                    var info = new qq.maps.InfoWindow({map: map});

                    qq.maps.event.addListener(marker, 'click', function () {
                        info.open();
                        info.setContent('<div style="margin:10px;font-size:small;"><img width="100" src="'+users.avatars[i]+'"/><br/>'+users.nicknames[i]+'<br/>'+users.distances[i]+'</div>');
                        info.setPosition(marker.getPosition());
                    });
                });
            });
        }(window, window.jQuery));
    </script>
@endsection
