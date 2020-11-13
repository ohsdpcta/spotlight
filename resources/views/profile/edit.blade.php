@extends('layouts/user')

@section('content')
    <form action="edit" method="post">
    @csrf
        <input type="hidden" name="id" value="{{ $data->id }}">
        <textarea name="変更内容" cols="50" rows="5"></textarea>
        <input type="submit" value="修正">
    </form>
@endsection
