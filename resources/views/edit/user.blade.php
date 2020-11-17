@extends('layouts/edit')

{{-- ------------------------------------------------------------------------- --}}

@section('R_form')

    <style>
        label {color:#ffffff;}
    </style>


    <h3 class="text-light">ユーザー情報変更</h3>
    <br>
    <form action="/user/{{request()->id}}/profile" method="post">
        @csrf
        <div class="form-group">
            <label>UserName</label><input type="text" name="name" class="form-control">
            <br>
            <label>Mail</label><input type="text" name="mail" class="form-control">
            <br>
            <label>PassWord</label><input type="text" name="pass" class="form-control">
            <br>
            <input type="submit" value="登録" class="btn btn-primary">
            <br>
        </div>
    </form>

@endsection