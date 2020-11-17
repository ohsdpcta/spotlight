@extends('layouts.user')

@section('content')
    <form action="goods/multi_del" method="post">
        @csrf
        @foreach ($data as $item)
            グッズ: {{ $data->name }}<br>
            URL: {{ $data->url }}<br><br>
        @endforeach
        <input type="submit" value="削除">このグッズを削除します。よろしいですか？
    </form>
@endsection
