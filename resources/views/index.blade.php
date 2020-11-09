@extends('layouts.main')

@section('content')
    <form action="/search" method="post">
        @csrf
        <input type="text" name="input" value="">
        <button type="sumbit">検索</button>
@endsection
