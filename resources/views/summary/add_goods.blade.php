@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>グッズ追加 / Spotlight</title>

@section('R_form')

<style>
    label {color:#ffffff;}
</style>

<h3 class="text-dark">グッズ情報追加</h3>
<hr>
<form action="add" method="post">
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
        <label>グッズ名</label><input type="text" name="name" class="form-control">
        <br>
        <label>URL</label><input type="text" name="url" class="form-control">
        <br>
        <input type="submit" value="追加" class="btn btn-primary">
    </div>
</form>

@endsection





