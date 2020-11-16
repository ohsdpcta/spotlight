@extends('layouts.user')

@section('content')
    <form action="add" method="post">
        @csrf
            グッズ名:<input type="text" name="name"><br>
        　　 URL:<input type="text" name="url"><br><br>
        <input type="submit" value="登録">
    </form>
@endsection
