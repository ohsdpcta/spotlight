@extends('layouts/user')

@section('content')

<html>
<head>
    <meta charset="utf-8">
    <title>サンプルページ</title>
</head>
<body>
    <p><a href="sample/add">サンプルリンクの追加</a></p><br>

    @foreach($data as $item)
        <p><a href="{{ $item->url }}">{{ $item->name }}　　　
        </a><a href="/user/{{ $item->id }}/sample/del">削除</p>
    @endforeach
</body>
</html>
@endsection