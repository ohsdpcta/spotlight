@extends('layouts.main')

@section('user')

<html>
  <head>
    <title>投げ銭 / Spotlight</title>
  </head>
  <body>
    <div class="text-light">
      <p>{{$url}}</p>
      <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $url }}&size=100x100" alt="QRコード" />
      <img src="https://api.qrserver.com/v1/create-qr-code/?data=イケてないコード&size=100x100" alt="QRコード" />
    </div>
  </body>
</html>

@endsection