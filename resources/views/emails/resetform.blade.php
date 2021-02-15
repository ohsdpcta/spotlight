@extends('layouts/signin')
{{-- ----------------------------------------------------------------- --}}
<html>
    <head>
        <meta charset="utf-8">
        <title>パスワードリセットメール送信ページ　/　Spotlight</title>
    </head>
    @section('signin')
        <p>パスワードリセットメール送信を行いますか？</p>
    <form action="resetmail" method="POST">
        @csrf
            <label><input type="text" name="email" value="" placeholder="メールアドレスを入力"></label>
            <label><input type="submit" name="send" value="送信"> </label>

        </form>
    @endsection
</html>
