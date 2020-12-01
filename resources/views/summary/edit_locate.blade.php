@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

@section('R_form')

<html>
<head>
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key="></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js"></script>
    <meta charset="utf-8">
    <title>ロケーション編集 / Spotlight</title>
    <style>
        label {color:#ffffff;}
        #map {
        width: 100%;
        height: 400px;
        background-color: grey;
        }
    </style>
</head>
<body>
    <h3 class="text-light">ロケーション編集</h3>
    <div class="pt-3">
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
        <form action="/user/{{Auth::id()}}/summary/locate" method="post">
            <table>
                @csrf
                {{-- 各種フォーム入力欄 --}}
                {{-- バリデーションエラーがあった場合は、old関数で入力データを復元する --}}
                <label>活動場所(座標)</label><br>
                <input type="text" id="latlng" class="form-control" name="coordinate" value="{{old('coordinate')}}" maxlength="30" placeholder="登録したい住所の座標を入力してください。"><br>
                {{-- 各種ボタン --}}
                <input type="submit" value="登録" class="float-right"><br>
            </table>
        </form>
    </div>
<body>
    <div id="map"></div><br>
    @if($locate_array)
        <form action="/user/{{Auth::id()}}/summary/locate/delete" method="post">
            @csrf
            {{-- 削除ボタン --}}
            <table>
                <input type="submit" value="住所を削除" class="float-right">
            </table>
        </form>
    @endif
</body>
    <script>
        const [default_lat, default_lng] = setDefaultProperty();
        map = new GMaps({
            div: '#map', //地図を表示する要素
            lat: default_lat, //緯度
            lng: default_lng, //軽度
            zoom: 18,   //倍率（1～21）
        });
        map.addMarker({
            lat: default_lat,
            lng: default_lng,
        });

        map.addListener('click', function(e) {
            getClickLatLng(e.latLng, map);
        });

        function getClickLatLng(lat_lng, map) {
            document.getElementById('latlng').value = lat_lng.lat() + ',' + lat_lng.lng();
            map.removeMarkers();
            // マーカーを設置
            map.addMarker({
                lat: lat_lng.lat(),
                lng: lat_lng.lng(),
            });
        }

        function setDefaultProperty(){
            let lat, lng;
            if({{count($locate_array)}}){
                lat = {{$locate_array[0]}};
                lng = {{$locate_array[1]}};
            }else{
                lat = 35.6896342;
                lng = 139.6921006;
            }
            return [lat, lng];
        }
    </script>
</html>

@endsection