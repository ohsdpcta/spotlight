@extends('layouts/user')

@section('content')

<html>

<head>
    <meta charset="utf-8">
    <title>ロケーション</title>
    <style>
        #map {
        width: 100%;
        height: 400px;
        background-color: grey;
        }
    </style>
</head>

<body>
    <button>現在地を取得ボタン</button>
    <div>
        <script>
            latlngはピンを落とす緯度と経度を設定する変数らしい
            function initMap() {
                var latlng = new google.maps.LatLng( 34.808502, 135.639683 );//中心の緯度, 経度
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 14,//ズームの調整
                  center: latlng//上で設定した中心
                });
                var marker = new google.maps.Marker({
                  position: latlng,
                  map: map
                });
              }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=[取得したAPIキー]&callback=initMap"></script>
        <div id="map"></div>
    </div>
</body>

</html>

@endsection