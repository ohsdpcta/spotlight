@extends('layouts/user')

@section('content')
    <form action="del" method="post">
        @csrf

            リンク名: {{ $data->name }}<br>
        　　 URL: <a href="{{$data->url }}">{{ $data->url }}</a><br><br>

        <input type="submit" value="削除">このサンプルリンクを削除します。よろしいですか？
    </form>
@endsection
