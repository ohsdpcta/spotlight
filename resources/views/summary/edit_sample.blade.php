@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>サンプル編集 / Spotlight</title>

@section('R_form')

<style>
    label {color:#ffffff;}
</style>

<h3 class="text-dark">サンプル情報編集</h3>
<hr>
<form action="edit" method="post">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
        {{-- <label>サンプル画像</label><input type="text" name="name" class="form-control"> --}}
        <label>サンプル名</label><input type="text" name="name" class="form-control" value="{{ $data->name }}">
        <br>
        <label>URL</label><input type="text" name="url" class="form-control" value="{{ $data->url }}">
        <br>
        <input type="submit" value="確定" class="btn btn-primary">
    </div>
</form>

@endsection





