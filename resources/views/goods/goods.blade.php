@extends('layouts.user')

@section('content')
<html>
<head>
    <meta charset="utf-8">
    <title>サンプルページ</title>
</head>
<body>

    @if(count($data)==0)
        商品が登録されていません
    @else

                <a href="{{ $item->url }}">{{ $item->name }}</a>

    @endif
</body>
</html>
@endsection
