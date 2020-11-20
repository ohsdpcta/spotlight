@extends('layouts.user')

@section('content')
    <form action="edit" method="post">
        @csrf
        グッズ名:<input type="text" name="name" value="{{$data->name}}"><br>
        　　 URL:<input type="text" name="url" value="{{$data->url}}"><br><br>
        <input type="submit" value="登録">
    </form>
@endsection
