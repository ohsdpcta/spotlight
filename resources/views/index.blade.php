@extends('layouts.main')

@section('user')
    <form action="/search" method="post">
        @csrf
        <input type="text" name="input" value="">
        <button type="sumbit">検索</button>
    </form>
@endsection
