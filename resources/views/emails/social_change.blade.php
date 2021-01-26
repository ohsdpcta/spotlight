@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<html>
    <head>
        <meta charset="utf-8">
        <title>ソーシャルID変更メール送信ページ　/　Spotlight</title>
    </head>
    @section('R_form')
        <p>ソーシャルID変更メールの送信を行いますか？</p>
    <form action="socialemail" method="POST">
        @csrf
            <label><input type="submit" name="send" value="送信"> </label>

        </form>
        @endsection
</html>
