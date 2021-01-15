@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>タグ追加 / Spotlight</title>

@section('R_form')

<h3 class="text-dark">タグ情報編集</h3>
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
        <label>タグ</label><input type="text" name="name" class="form-control">
        <br>
        <input type="submit" value="追加" class="btn btn-primary">
    </div>
</form>

@endsection





