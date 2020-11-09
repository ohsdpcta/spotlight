@extends('layouts/main')

@section('content')
    <form action="edit" method="post">
    @csrf
        <input type="hidden" name="id" value="{{ $form->id }}">
        <input type="text" name="content" value="{{ $form->content }}">
        <input type="submit" value="修正">
    </form>
@endsection