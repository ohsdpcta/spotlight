@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>アカウント編集 / Spotlight</title>

@section('R_form')
    {{-- @include('components/all_info') --}}

    <h3 class="text-dark">ユーザー情報編集</h3>
    <br>
    <form action="/user/{{Auth::id()}}/summary/account" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <label>ユーザー名</label>
            <input type="text" name="name" value="{{ $data->name }}" class="form-control">
            <br>
            <div class="row pl-3">
                <label>ロール</label>
                <div class="pt-1 pl-2">
                    @include('components/modal/edit_account/modal_role')
                </div>
            </div>
            <div class="form-check-inline">
                <label><input class="form-check-input" type="radio" name="role" value="Performer" {{ $data->role == "Performer" ? 'checked="checked"' : ''}}>パフォーマー</label>
            </div>
            <div class="form-check-inline">
                <label><input class="form-check-input" type="radio" name="role" value="Spotter" {{ $data->role == "Spotter" ? 'checked="checked"' : ''}}>スポッター</label>
            </div>
            <br>

            <div class="mt-2">
                <input type="submit" value="修正" class="btn btn-success">
                <button type="button" class="btn btn-danger" onclick="location.href='/user/{{Auth::id()}}/summary/account/delete'">削除</button>
            </div>
        </div>
    </form>
    <?php
        $modal_content2 = '
            <br><h3>サンプル<div class="js-modal-close close float-right">×</div><hr></h3>
            <h6 class="font-weight-bold">サンプル</h6>
        '
    ?>@if(empty($data->token))
        <label>*パスワード変更</label>
        <p>現在のパスワードと新しいパスワードを入力してください</p>
        <form action="/user/{{Auth::id()}}/summary/account/changeupdate" method="POST">
            @csrf
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>現在のパスワード::</td><td><input type="password" name="old_password" value=""></td>
                </tr>
                <tr>
                    <td>新しいパスワード::</td><td><input type="password" name="new_password" value=""></td>
                <tr>
                <tr>
                    <td>新しいパスワードの確認::</td><td><input type="password" name="new_password_check" value=""></td>
                </tr>
            </table>
            <label><input type="submit" class="btn btn-primary" name="send" value="変更"> </label>
        </form>
    @endif
    <label>*ソーシャルID変更</label>
    <p>新しいソーシャルIDを入力してください</p>
    <form action="/user/{{Auth::id()}}/summary/account/socialupdate" method="POST">
        @csrf
        <table>
            <tr>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <td>新しいソーシャルID::</td><td><input type="text" class="form-control" name="new_social" value=""></td>
            <tr>
            <tr>
                <td>新しいソーシャルIDの確認::</td><td><input type="text" class="form-control" name="new_social_confirmation" value=""></td>
            </tr>
        </table>
        <label><input type="submit" class="btn btn-primary" name="send" value="変更"> </label>
    </form>
    @if(empty($data->token))
        <label>*メールアドレス変更</label>
        <p>新しいメールアドレスを入力してください</p>
        <form action="/user/{{Auth::id()}}/summary/account/mailupdate" method="POST">
            @csrf
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <div class="form-group">
                        <td>新しいメールアドレス::</td><td><input type="text"  class="form-control" name="new_mail" value=""></td>
                    </div>
                <tr>
                <tr>
                    <div class="form-group">
                        <td>新しいメールアドレスの確認::</td><td><input type="text" class="form-control" name="new_mail_confirmation" value=""></td>
                    </div>
                </tr>
            </table>
            <label><input type="submit" class="btn btn-primary" name="send" value="変更"> </label>
        </form>
    @endif

    サンプルボーダル@include('components/modal/edit_account/modal_email')
@endsection
