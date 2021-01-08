@extends('layouts/signin')

<meta charset="utf-8">
<title>サインイン / Spotlight</title>

@section('signin')

<h1 class="pt-3">サインイン</h1>
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
    <form action="/user/signin" method="POST">
        <table>
            @csrf
            {{-- 各種フォーム入力欄 --}}
            {{-- バリデーションエラーがあった場合は、old関数で入力データを復元する --}}
            <tr><th>メールアドレス or ユーザーID</th><td><input class="form-control" type="text" name="login_id" value="{{old('login_id')}}"></td></tr>
            <tr><th>パスワード</th><td><input class="form-control" type="password" name="password" ></td></tr>
            <tr><th>ログイン状態を保持</th><td><input type="checkbox" name="remember" value="true"></td></tr>
            {{-- 各種ボタン --}}
            <tr><th></th><td><input type="submit" class="btn btn-primary" value="ログイン"></td></tr>
            <tr><th>ソーシャルログイン</th></tr>
            <tr><th>
                <a onclick="location.href='/user/signin/twitter'" class="btn btn-light">
                    <i class="fab fa-twitter text-primary"></i> Twitter
                </a>
                <a onclick="location.href='/user/signin/google'" class="btn btn-light">
                    <img src="https://www.flaticon.com/svg/static/icons/svg/281/281764.svg" width="15" height="15"> Google
                </a>
            </th></tr>
        </table>
    </form>

@endsection
