@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<html>
    <head>
        <meta charset="utf-8">
        <title>メールアドレス確定ページ/　Spotlight</title>
    </head>
    @section('R_form')
    <h3 class="text-dark">メールアドレス変更</h3>
    <br>
        <h5 class="text-dark">確定ボタンを押すことでメールアドレスを確定します。</h5>
        <form action="/user/{{ $id }}/summary/account/donemail/done/{{ $token }}" method="POST">
            @csrf
            <label><input type="submit" class="btn btn-primary" name="send" value="確定"> </label>
        </form>
        @endsection
</html>
