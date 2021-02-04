@extends('layouts/main')

{{-- ----------------------------------------------------------------- --}}

<html>
    <head>
        <meta charset="utf-8">
        <title>認証エラー　/　Spotlight</title>
    </head>
    @section('user')
    <div class="container">
        <br>
    <h1>エラーが発生しました！！</h1>
    <p>認証エラーが発生しました。<br>
    エラー内容:{{$message}}</p>
    <a href="/">ホーム画面へ</a>
    <a href="/user/signup">会員登録画面へ</a>
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
