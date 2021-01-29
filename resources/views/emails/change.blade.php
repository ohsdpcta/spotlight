
@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}
<html>
    <head>
        <meta charset="utf-8">
        <title>パスワード変更確認ページ　/　Spotlight</title>
    </head>
    @section('R_form')
        <p>パスワード変更を行いますか？</p>
    <form action="changemail" method="POST">
        @csrf
            <label><input type="submit" name="send" value="実行"> </label>

        </form>
    @endsection
</html>
