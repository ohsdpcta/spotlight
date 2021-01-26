@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<html>
    <head>
        <meta charset="utf-8">
        <title>ソーシャルID変更ページ　/　Spotlight</title>
    </head>
    @section('R_form')
        <p>今のソーシャルIDと新しいソーシャルIDを入力してください</p>
        <form action="socialupdate" method="POST">
            @csrf
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>今のソーシャルID::</td><td><input type="text" name="old_social" value=""></td>
                </tr>
                <tr>
                    <td>新しいソーシャルID::</td><td><input type="text" name="new_social" value=""></td>
                <tr>
                <tr>
                    <td>新しいソーシャルIDの確認::</td><td><input type="text" name="new_social_check" value=""></td>
                </tr>
            </table>
            <label><input type="submit" name="send" value="変更"> </label>

        </form>

    @endsection
</html>
