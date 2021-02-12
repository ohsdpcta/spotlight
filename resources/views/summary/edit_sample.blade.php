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
        <label style="color:#353535">サンプル名</label><input type="text" name="name" class="form-control">
        <br>
        <label>
            <div class="row pl-3">
                <h6 style="color:#505050">URL</h6>
                <div class="pt-1 pl-2">@include('components/modal/add_sample/modal_video')</div>
            </div>
        </label>
        <input type="text" name="url" class="form-control">
        <br>
        <input type="submit" value="編集" class="btn btn-primary">
    </div>
</form>

@endsection





