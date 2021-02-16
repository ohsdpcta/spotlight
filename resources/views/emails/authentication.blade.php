@extends('layouts/main')

{{-- ----------------------------------------------------------------- --}}
<html>
    <head>
        <meta charset="utf-8">
        <title>アカウント本登録　/　Spotlight</title>
    </head>

    @section('user')
    <div class="container">
        <br>
        <h3>アカウント本登録</h3>
        <br>
        <h5>ご登録した名前とメールアドレスのご確認をお願いいたします。</h5>
        <form action="/user/emails/confirmation" method="POST">
        @csrf

        <h6>お名前:{{$users->name}}</h6>
        <h6>メールアドレス:{{$users->email}}</h6>
        <label><input type="submit" class="btn btn-primary"  name="conf" value="認証"></label>
        </form>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>

    @endsection


</html>


