@extends('layouts/signin')

{{-- ----------------------------------------------------------------- --}}

<html>
    <head>
        <meta charset="utf-8">
        <title>パスワードリセットフォームページ　/　Spotlight</title>
    </head>

    @section('signin')
    {{-- バリデーションエラーがある場合は出力 --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <p>新しいパスワードを入力してください</p>
        <form action="resetpass" method="POST">
            @csrf
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>新しいパスワード::</td><td><input type="password" name="new_password" value=""></td>
                <tr>
                <tr>
                    <td>新しいパスワードの確認::</td><td><input type="password" name="new_password_check" value=""></td>
                </tr>
            </table>
            <p><input type="hidden" name="email_token" value="{{$email_token}}"></p>
            <label><input type="submit" name="send" value="変更"> </label>

        </form>
        @endsection
</html>
