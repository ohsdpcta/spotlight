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
            <label>UserName</label><input type="text" name="name" value="{{ $data->name }}" class="form-control">
            <br>
            <input type="submit" value="修正" class="btn btn-primary">
        </div>
    </form>
    <button type="button" class="btn btn-danger" onclick="location.href='/user/{{Auth::id()}}/summary/account/delete'">削除</button>

@endsection