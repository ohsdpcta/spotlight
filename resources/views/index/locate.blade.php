@extends('layouts.user')

@section('content')

<html>

<head>
  <meta charset="utf-8">
  <title>ロケーション / Spotlight</title>
  <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_APP_KEY')}}"></script>
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
  @if($locate_array)
    <div id="map"></div>
  @else
    ロケーションが未設定です
  @endif
</body>
@if($locate_array)
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
@endif
</html>

@endsection