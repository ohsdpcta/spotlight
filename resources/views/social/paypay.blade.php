@extends('layouts.main')

@section('user')

<html>
  <head>
    <title>投げ銭 / Spotlight</title>
  </head>
  <body>
    <div class="text-light p-5">
      <a href="{{ $url }}"><img src="https://iconlab.kentakomiya.com/wp/wp-content/uploads/2019/06/icon0084.png" alt="スマートフォン" width="150" height="150"></a>
      <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $url }}&size=150x150" alt="PC" class="pl-4" />
    </div>
  </body>
</html>

@endsection