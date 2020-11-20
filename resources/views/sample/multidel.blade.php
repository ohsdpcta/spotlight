@extends('layouts.user')

@section('content')

<form method="post" action="confirm">
    @csrf
    @foreach ($data as $item)
        <div class="del-check">
            <input id="{{ $item->id }}" type="checkbox" name="checkbox[]" value="{{ $item->id }}"{{ is_array(old("checkbox")) && in_array("{ $item->id }", old("checkbox"), true)? ' checked' : '' }}>
            <label for="{{ $item->id }}">{{ $item->name }}  {{ $item->url }}<br></label>
        </div>
    @endforeach
    <input type="submit" value="削除">
</form>
@endsection