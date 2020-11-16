@extends('layouts/user')

@section('content')

<html>

<head>
  <meta charset="utf-8">
  <title>ロケーション</title>
  <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key="></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js"></script>
  <style>
    #map {
      width: 100%;
      height: 400px;
      background-color: grey;
    }
  </style>
</head>

<body>
    <div id="map"></div>
</body>

<script>
  map = new GMaps({
    div: '#map', //地図を表示する要素
    lat: {{$locate_array[0]}}, //緯度
    lng: {{$locate_array[1]}}, //軽度
    zoom: 18,   //倍率（1～21）
  });
  map.addMarker({
    lat: {{$locate_array[0]}},
    lng: {{$locate_array[1]}},
  });
</script>

</html>

@endsection