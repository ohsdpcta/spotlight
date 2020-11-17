@extends('layouts/user')

@section('content')
    <form action="del" method="post">
    @csrf
        @foreach($data as $item)
            リンク名: {{ $item->name }}<br>
        　　 URL: {{ $item->url }}<br><br>
        @endforeach
        <input type="submit" value="削除">このサンプルリンクを削除します。よろしいですか？
    </form>
@endsection