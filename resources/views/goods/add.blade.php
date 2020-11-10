@extends('layouts.main')

@section('content')
    <form action="/user/{id}/goods" method="post">
        <table>
            @csrf
            <tr><th>name: </th><td><input type="text" name="name"></td></tr>
            <tr><th>url: </th><td><input type="text" name="url"></td></tr>
            <tr><th></th><td><input type="submit" value="登録"></td></tr>
        </table>
    </form>
@endsection