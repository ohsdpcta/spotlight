@extends('layouts.user')

<meta charset="utf-8">
<title>グッズ削除 / Spotlight</title>

@section('content')
    <form action="multi_del" method="post">
        @csrf
        @foreach ($data as $item)
            <input type="hidden" name="goods_id[]" value="{{$item->id}}">
            グッズ: {{ $item->name }}<br>
            URL: <a href="{{ $item->url }}">{{ $item->url }}</a><br><br>
        @endforeach
        <input type="submit" value="削除">このグッズを削除します。よろしいですか？
    </form>
@endsection
