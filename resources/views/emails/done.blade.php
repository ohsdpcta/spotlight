@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<html>
    <head>
        <meta charset="utf-8">
        <title>メールアドレス確定ページ/　Spotlight</title>
    </head>
    @section('R_form')
        <p>確定を押すことでメールアドレスを確定します。</p>
        <form action="/user/{{ $id }}/summary/account/donemail/done/{{ $token }}" method="POST">
            @csrf

            <label><input type="submit" class="btn btn-primary" name="send" value="確定"> </label>
        </form>
        @endsection
</html>
