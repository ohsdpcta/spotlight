@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

@section('R_form')

<?php
    $locate_tag = UserClass::getLocateTag(request()->id);
?>
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
                @if($locate_tag)
                    <label>活動地域</label>
                    <div>
                        <a href="">#{{ $locate_tag->prefecture_tag_name }}</a>
                        <a href="">#{{ $locate_tag->city_tag_name }}</a>
                    </div>
                @endif
                <input type="text" id="placename" class="form-control" placeholder="地名を入力で移動">
                <input type="text" id="latlng" class="form-control col-lg-12 col-md-12 col-sm-12 col-xs-12" name="coordinate" value="{{old('coordinate')}}" hidden>
                <input type="text" id="address" name="address" hidden>
            </form>
        </div>
    </div>
    <div id="map" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div><br>
    <div class="float-lg-right float-md-right float-sm-right float-xs-right pt-1 pb-3">
        @if($locate_array)
            <input type="submit" value="修正" id="save" class="btn btn-success">
            <button type="button" class="btn btn-danger" onclick="location.href='/user/{{Auth::id()}}/summary/locate/delete'">削除</button>
        @else
            <input type="submit" value="登録" id="save" class="btn btn-primary">
        @endif
    </div>

    <script>
        new Vue({
            created: function() {
                const geocoder = new google.maps.Geocoder();
                const [default_lat, default_lng, default_zoom] = this.setDefaultProperty();
                const map = new GMaps({
                    div: '#map', //地図を表示する要素
                    lat: default_lat, // 緯度
                    lng: default_lng, // 経度
                    zoom: default_zoom,   //倍率（1～21）
                });

                map.addMarker({
                    lat: default_lat,
                    lng: default_lng,
                });

                map.addListener('click', (e) => {
                    this.getClickLatLng(e.latLng, map);
                });

                document.getElementById('save').addEventListener('click', (e) => {
                    e.preventDefault();
                    this.getAddress(geocoder, map);
                });

                document.getElementById("placename").addEventListener("change", (e) => {
                    const placename = document.getElementById('placename').value.trim();
                    if(placename){
                        this.goAddress(geocoder, map, placename);
                    }
                });
            },
            methods: {
                getClickLatLng: function (lat_lng, map){
                    document.getElementById('latlng').value = lat_lng.lat() + ',' + lat_lng.lng();
                    map.removeMarkers();
                    // マーカーを設置
                    map.addMarker({
                        lat: lat_lng.lat(),
                        lng: lat_lng.lng(),
                    });
                },

                setDefaultProperty: function (){
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
                },
                getAddress: function (geocoder, map){
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
                },
                goAddress: function (geocoder, map, placename){
                    geocoder.geocode({ address: placename }, (results, status) => {
                        if (status === "OK") {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            map.setCenter(lat, lng);
                            map.setZoom(17);
                        } else {
                            alert("移動できませんでした: " + status);
                        }
                    });
                }
            }
        });
    </script>
</html>

@endsection
