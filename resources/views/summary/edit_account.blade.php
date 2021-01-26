@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>アカウント編集 / Spotlight</title>

@section('R_form')

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
            <label>UserName</label><input type="text" name="name" value="{{ $data->name }}" class="form-control">
            <br>
            <label>
                <div class="row pl-3">
                    ロール
                    <div class="pt-1 pl-2">@include('components/user_info')</div>
                </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="role" value="パフォーマー" {{ $data->role == "パフォーマー" ? 'checked="checked"' : ''}}>パフォーマー
            </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="role" value="スポッター" {{ $data->role == "スポッター" ? 'checked="checked"' : ''}}>スポッター
            </div><div></div>
            <label>
            <br>
            <div class="mt-2">
                <input type="submit" value="修正" class="btn btn-success">
                <button type="button" class="btn btn-danger" onclick="location.href='/user/{{Auth::id()}}/summary/account/delete'">削除</button>
            </div>
        </div>
        <label>*パスワード変更</label>
            <p><a href="/user/{{Auth::id()}}/summary/change/">パスワード変更</a></p>
        <label>*ソーシャルID変更</label>
            <p><a href="/user/{{Auth::id()}}/summary/social_change/">ソーシャルID変更</a></p>
        <label>*メールアドレス変更</label>
            <p><a href="/user/{{Auth::id()}}/summary/mail_change/">メールアドレス変更</a></p>

    </form>

@endsection
