@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<html>
    <head>
        <meta charset="utf-8">
        <title>メールアドレス変更ページ　/　Spotlight</title>
    </head>
    @section('R_form')
        <p>現在のメールアドレスと新しいメールアドレスを入力してください</p>
        <form action="mailupdate" method="POST">
            @csrf

            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <div class="form-group">
                        <td>現在のメールアドレス::</td><td><input type="text" class="form-control" name="old_mail" value=""></td>
                    </div>
                </tr>
                <tr>
                    <div class="form-group">
                        <td>新しいメールアドレス::</td><td><input type="text"  class="form-control" name="new_mail" value=""></td>
                    </div>
                <tr>
                <tr>
                    <div class="form-group">
                        <td>新しいメールアドレスの確認::</td><td><input type="text" class="form-control" name="new_mail_check" value=""></td>
                    </div>
                </tr>
            </table>
            <label><input type="submit" class="btn btn-primary" name="send" value="変更"> </label>


        </form>
        @endsection
</html>
