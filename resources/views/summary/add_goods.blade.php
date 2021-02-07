@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>グッズ追加 / Spotlight</title>

@section('R_form')

<h3 class="text-dark">グッズ情報追加</h3>
<hr>
<form action="add" method="post" enctype="multipart/form-data">
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
        <label>グッズ名</label><input type="text" name="name" class="form-control" value="{{old('name')}}">
        <br>
        <label>URL</label><input type="text" name="url" class="form-control" value="{{old('url')}}">
        <br>
        <div class="row">
            <label class="col-12">グッズイメージ</label>
            <input type="file" name="goods_picture" class="col-12">
        </div>
        <br>
        <input type="submit" value="追加" class="btn btn-primary">
    </div>
</form>

@endsection





