@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>サンプル削除 / Spotlight</title>

@section('R_form')

<style>
    label {color:#ffffff;}
</style>

<h3 class="text-light">サンプル情報削除</h3>
<hr>
<form action="del" method="post">
    @csrf
    <div class="form-group">
        {{-- <label>サンプル画像</label><input type="text" name="name" class="form-control"> --}}
        @foreach ($data as $item)
            {{ $item['name'] }}{{ $item['url']}}
        @endforeach
        <input type="submit" value="削除" class="btn btn-danger">
    </div>
</form>

@endsection
