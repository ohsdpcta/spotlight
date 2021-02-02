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
                <label><input class="form-check-input" type="radio" name="role" value="パフォーマー" {{ $data->role == "パフォーマー" ? 'checked="checked"' : ''}}>パフォーマー</label>
            </div>
            <div class="form-check-inline">
                <label><input class="form-check-input" type="radio" name="role" value="スポッター" {{ $data->role == "スポッター" ? 'checked="checked"' : ''}}>スポッター</label>
            </div><div></div>
            <br>

            <div class="mt-2">
                <input type="submit" value="修正" class="btn btn-success">
                <button type="button" class="btn btn-danger" onclick="location.href='/user/{{Auth::id()}}/summary/account/delete'">削除</button>
            </div>
        </div>
        <?php
            $modal_content2 = '
                <br><h3>サンプル<div class="js-modal-close close float-right">×</div><hr></h3>
                <h6 class="font-weight-bold">サンプル</h6>
            '
        ?>
        <label>*パスワード変更</label>
            <p><a href="/user/{{Auth::id()}}/summary/change/">パスワード変更</a></p>
        <label>*ソーシャルID変更</label>
            <p><a href="/user/{{Auth::id()}}/summary/social_change/">ソーシャルID変更</a></p>
        <label>*メールアドレス変更</label>
            <p><a href="/user/{{Auth::id()}}/summary/mail_change/">メールアドレス変更</a></p>
        @include('components/modal/edit_account/modal_email')サンプルボーダル
    </form>
@endsection