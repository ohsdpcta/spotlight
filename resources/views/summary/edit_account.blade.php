@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>アカウント編集 / Spotlight</title>

@section('R_form')

    <style>
        label {color:#ffffff;}
    </style>


    <h3 class="text-light">ユーザー情報編集</h3>
    <br>
    <form action="/user/{{Auth::id()}}/summary/account" method="post">
        @csrf
        <div class="form-group">
            <label>UserName</label><input type="text" name="name" value="{{ $data->name }}" class="form-control">
            <br>
            <label>Email</label><input type="text" name="email" value="{{ $data->email }}" class="form-control">
            <br>
            <input type="submit" value="登録" class="btn btn-primary">
            <br>
        </div>
    </form>

@endsection