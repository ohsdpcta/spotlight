@extends('layouts/signup')

<meta charset="utf-8">
<title>サインアップ / Spotlight</title>

@section('signup')

<h1 class="pt-3">新規登録</h1>
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
    @if (Session::has('success'))
        <div id="sample">
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
    <form action="/user/signup" method="POST">
        <table>
            @csrf
            <tr><th>ユーザー名</th><td><input class="form-control" type="text" name="name" value="{{old('name')}}"></td></tr>
            <tr><th>ユーザーID</th><td><input class="form-control" type="text" name="social_id" value="{{old('social_id')}}"></td></tr>
            <tr><th>メールアドレス</th><td><input class="form-control" type="email" name="email" value="{{old('email')}}"></td></tr>
            <tr><th>パスワード</th><td><input class="form-control" type="password" name="password" ></td></tr>
            <tr><th>パスワード確認</th><td><input class="form-control" type="password" name="password_confirmation" ></td></tr>
            {{-- 各種ボタン --}}
            <tr><th></th><td><input type="submit" class="btn btn-primary" value="登録"></td></tr>
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
