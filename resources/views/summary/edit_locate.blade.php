@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

@section('R_form')

<html>
    <head>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.gmap.key') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js"></script>
        <meta charset="utf-8">
        <title>ロケーション編集 / Spotlight</title>
        <style>
            #map {
            width: 100%;
            height: 400px;
            background-color: grey;
            }
        </style>
    </head>

    <h3 class="text-dark">ロケーション編集</h3>
    <div class="pt-3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        {{-- バリデーションエラーがある場合は出力 --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <form action="/user/{{Auth::id()}}/summary/locate" method="post" name="locate_form">
                @csrf
                {{-- 各種フォーム入力欄 --}}
                <label>活動地域</label><br>
                <input type="text" name="prefecture_city" class="form-control" @isset($locate_data->prefecture) value="{{ $locate_data->prefecture }}{{ $locate_data->city }}" @endisset placeholder="登録する住所を入力してください。例:東京都品川区"><br>
                <label>活動場所(座標)</label><br>
                <input type="text" id="latlng" class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" name="coordinate" value="{{old('coordinate')}}" placeholder="登録する住所の座標を入力してください。">
                <input type="text" id="address" name="address" hidden>
                {{-- 各種ボタン --}}
                <div class="float-lg-right float-md-right float-sm-right float-xs-right pt-1 pb-3">
                    @if($locate_array)
                        <input type="submit" value="修正" id="save" class="btn btn-success">
                        <button type="button" class="btn btn-danger" onclick="location.href='/user/{{Auth::id()}}/summary/locate/delete'">削除</button>
                    @else
                        <input type="submit" value="登録" id="save" class="btn btn-primary">
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div id="map" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div><br>

    <script>
        const geocoder = new google.maps.Geocoder();
        const save_btn = document.getElementById('save');
        const [default_lat, default_lng, default_zoom] = setDefaultProperty();

        map = new GMaps({
            div: '#map', //地図を表示する要素
            lat: default_lat, // 緯度
            lng: default_lng, // 経度
            zoom: default_zoom,   //倍率（1～21）
        });

        map.addListener('click', function(e) {
            getClickLatLng(e.latLng, map);
        });
        save_btn.addEventListener('click', function(e) {
            e.preventDefault();
            getAddress();
        })

        function getClickLatLng(lat_lng, map) {
            document.getElementById('latlng').value = lat_lng.lat() + ',' + lat_lng.lng();
            map.removeMarkers();
            // マーカーを設置
            map.addMarker({
                lat: lat_lng.lat(),
                lng: lat_lng.lng(),
            });
        }

        map.addMarker({
            lat: default_lat,
            lng: default_lng,
        });

        function setDefaultProperty(){
            let lat, lng;
            const latlng_data = @json($locate_array);
            if({{count($locate_array)}}){
                lat = latlng_data[0];
                lng = latlng_data[1];
                zoom = 18;
            }else{
                lat = 35.6896342;
                lng = 139.6921006;
                zoom = 5;
            }
            return [lat, lng, zoom];
        }

        function getAddress(){
            const input = document.getElementById("latlng").value;
            const latlngStr = input.split(",", 2);
            const latlng = {
                lat: parseFloat(latlngStr[0]),
                lng: parseFloat(latlngStr[1]),
            };
            geocoder.geocode({ location: latlng }, (results, status) => {
                if (status === "OK") {
                    if (results[0]) {
                        document.getElementById('address').value = results[0].formatted_address;
                    } else {
                        window.alert("住所を特定できませんでした");
                    }
                } else {
                    window.alert("住所を特定できませんでした");
                }
                document.locate_form.submit();
            });
        }
    </script>
</html>

@endsection