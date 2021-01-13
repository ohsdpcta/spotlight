@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>アカウント削除 / Spotlight</title>

@section('R_form')

<h3 class="text-dark">アカウント削除</h3>
<hr>
<div class="form-group text-light">
    {{-- <label>サンプル画像</label><input type="text" name="name" class="form-control"> --}}
    <p>{{ $data->name }}</p>
    <button type="button" class="btn btn-danger" onclick="location.href='/user/{{Auth::id()}}/summary/account/remove'">削除</button>
</div>
@endsection