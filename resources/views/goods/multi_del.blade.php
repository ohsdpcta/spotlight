@extends('layouts.user')

@section('content')
    <form action="multi_del" method="post">
        @csrf
        @for ($i = 0; $i < $count; $i++)
            @if ({{$checkGoods}} == {{$id}})
                グッズ: {{ $data->name }}<br>
                URL: {{ $data->url }}<br><br>
            @endif
        @endfor
        <input type="submit" value="削除">このグッズを削除します。よろしいですか？
    </form>
@endsection
