@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<html>
    <head>
        <meta charset="utf-8">
        <title>メールアドレス変更メール送信ページ　/　Spotlight</title>
    </head>
    @section('R_form')
        <p>メールアドレス変更メールの送信を行いますか？</p>
    <form action="mail_email" method="POST">
        @csrf
            <label><input type="submit" name="send" value="送信"> </label>

        </form>
        @endsection
</html>
