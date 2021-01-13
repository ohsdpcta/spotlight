@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>グッズ編集 / Spotlight</title>

@section('R_form')

<h3 class="text-dark">グッズ情報編集</h3>
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
        <label>グッズ名</label><input type="text" name="name" class="form-control" value="{{$data->name}}">
        <br>
        <label>URL</label><input type="text" name="url" class="form-control" value="{{$data->url}}">
        <br>
        <input type="submit" value="修正" class="btn btn-success">
    </div>
</form>

@endsection





