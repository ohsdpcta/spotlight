@extends('layouts.user')

@section('content')

<html>

<head>
  <meta charset="utf-8">
  <title>ロケーション / Spotlight</title>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.gmap.key') }}"></script>
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
  <div class="border border-top-0 rounded-bottom px-4 py-3">
    @if($locate_array)
      <div id="map"></div>
    @else
      ロケーションが未設定です
    @endif
  </div>
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