@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<html>
    <head>
        <meta charset="utf-8">
        <title>メールアドレス変更確認ページ　/　Spotlight</title>
    </head>
    @section('R_form')
        <p>メールアドレス変更を行いますか？</p>
    <form action="mail_email" method="POST">
        @csrf
            <label><input type="submit" name="send" value="次へ"> </label>

        </form>
        @endsection
</html>
