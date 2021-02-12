@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>グッズ編集 / Spotlight</title>

@section('R_form')

<h3 class="text-dark">グッズ情報編集</h3>
<hr>
<form action="edit" method="post" enctype="multipart/form-data">
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
        <label>グッズ名</label><input type="text" name="name" class="form-control" value="{{$data->name}}">
        <br>
        <label>URL</label><input type="text" name="url" class="form-control" value="{{$data->url}}">
        <br>
        <div class="row">
            <label class="col-12">プロフィールアイコン</label>
            <!-- 現在設定されている画像 -->
            <div class="border-bottom col-xl-3 col-lg-3 col-md-4 col-sm-12 pt-2 pb-2">
                @if($data->picture)
                    <img src="{{ $data->picture }}" width="200" height="200" class="rounded-circle border">
                @else
                    <img src="http://placehold.jp/200x200.png" class="rounded-circle border">
                @endif
            </div>
            <input type="file" name="image" class="col-12">
        </div>
        <br>
        <input type="submit" value="修正" class="btn btn-success">
    </div>
</form>

@endsection





