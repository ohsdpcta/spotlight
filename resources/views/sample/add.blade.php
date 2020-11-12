@extends('layouts/main')

@section('content')
    <form action="add" method="post">
    @csrf
        リンク名:<input type="text" name="name"><br>
        　　 URL:<input type="text" name="url"><br><br>
        <input type="submit" value="サンプルリンクを追加">
    </form>
@endsection