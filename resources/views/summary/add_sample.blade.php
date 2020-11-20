@extends('layouts/edit')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>サンプル追加 / Spotlight</title>

@section('R_form')

<style>
    label {color:#ffffff;}
</style>

<h3 class="text-light">サンプル情報追加</h3>
<hr>
<form action="add" method="post">
    @csrf
    <div class="form-group">
        {{-- <label>サンプル画像</label><input type="text" name="name" class="form-control"> --}}
        <label>サンプル名</label><input type="text" name="name" class="form-control">
        <br>
        <label>URL</label><input type="text" name="url" class="form-control">
        <br>
        <input type="submit" value="追加" class="btn btn-primary">
    </div>
</form>

@endsection





