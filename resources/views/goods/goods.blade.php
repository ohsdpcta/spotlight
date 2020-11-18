@extends('layouts.user')

@section('content')
<html>
<head>
    <meta charset="utf-8">
    <title>サンプルページ</title>
</head>
<body>
    <p><a href="goods/add">商品の追加</a></p><br>
    @if(!empty($data))
        <form action="goods/multi_del" method="GET">
            @csrf
            @foreach($data as $item)
                <p><input type="checkbox" name="check_goods[]" value="{{$item->id}}">&nbsp;
                <a href="{{ $item->url }}">{{ $item->name }}</a>
                <a href="/user/{{request()->id}}/goods/{{$item->id}}/del">削除
                <a href="/user/{{request()->id}}/goods/{{$item->id}}/edit">編集</p>
            @endforeach
                {{--{{request()->id()}}でURLのユーザーID取得  --}}
                <p><input type="submit" value="選択削除"></p>
        </form>
    @else
        aaa
    @endif
</body>
</html>
@endsection
