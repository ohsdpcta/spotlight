@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>タグ削除 / Spotlight</title>

@section('R_form')

<style>
    label {color:#ffffff;}
</style>

<h3 class="text-dark">タグ情報削除</h3>
<hr>
<form action="/user/{{Auth::id()}}/summary/tag/delete" method="post">
    @csrf
    <div class="form-group text-dark">
        {{-- <label>サンプル画像</label><input type="text" name="name" class="form-control"> --}}
        @foreach($data as $item)
            {{ $item->tag_name }}
            <br>
        @endforeach
        <input type="hidden" name="checked_id_str" value="{{ $checked_id_str }}">
        <input type="submit" value="削除" class="btn btn-danger">
    </div>
</form>

@endsection





