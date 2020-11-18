@extends('layouts.user')

@section('content')
    <form action="multi_del" method="post">
        @csrf
        @foreach ($data as $item)
            <input type="hidden" name="sample_id[]" value="{{$item->id}}">
            サンプル: {{ $item->name }}<br>
            URL: <a href="{{ $item->url }}">{{ $item->url }}</a><br><br>
        @endforeach
        <input type="submit" value="削除">このグッズを削除します。よろしいですか？
    </form>
@endsection
