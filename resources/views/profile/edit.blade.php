@extends('layouts/user')

@section('content')
    <form action="edit" method="post">
    @csrf
        <input type="text" name="content" value="{{ $data->content }}">
        <input type="submit" value="修正">
    </form>
@endsection
