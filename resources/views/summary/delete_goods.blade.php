@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>グッズ削除 / Spotlight</title>

@section('R_form')

<style>
    label {color:#ffffff;}
</style>

<h3 class="text-light">グッズ情報削除</h3>
<hr>
<form action="/user/{{Auth::id()}}/summary/goods/delete" method="post">
    @csrf
    <div class="form-group text-light">
        {{-- <label>サンプル画像</label><input type="text" name="name" class="form-control"> --}}
        @foreach($data as $item)
            {{ $item->name }} ( <a href="{{ $item->url }}">{{ $item->url }}</a> )
            <br>
        @endforeach
        <input type="hidden" name="goods_id_str" value="{{ $goods_id_str }}">
        <input type="submit" value="削除" class="btn btn-danger">
    </div>
</form>

@endsection





