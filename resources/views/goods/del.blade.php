@extends('layouts.user')

@section('content')
    <form action="del" method="post">
        @csrf
        グッズ: {{ $data->name }}<br>
        URL: <a href="{{$data->url }}">{{ $data->url }}</a><br><br>
        <input type="submit" value="削除">このグッズを削除します。よろしいですか？
    </form>
@endsection
