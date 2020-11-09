@extends('layouts.main')

@section('profile')
    <form action="/search" method="post">
        @csrf
        <input type="text" name="input" value="">
        <button type="sumbit">検索</button>
@endsection
