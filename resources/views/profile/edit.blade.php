@extends('layouts/user')

@section('content')
    <form action="edit" method="post">
        @csrf
        <textarea name="content" cols="50" rows="5">{{ $data->content }}</textarea>
        <input type="submit" value="修正">
    </form>
@endsection
