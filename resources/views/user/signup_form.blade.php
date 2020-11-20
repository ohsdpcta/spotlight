@extends('layouts/signup')

<meta charset="utf-8">
<title>サインアップ / Spotlight</title>

@section('signup')

<h1>新規登録</h1>
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
    <form action="/user/signup" method="POST">
        <table>
            @csrf
            <tr><th>ユーザー名</th><td><input type="text" name="name" value="{{old('name')}}"></td></tr>
            <tr><th>ユーザーID</th><td><input type="text" name="social_id" value="{{old('social_id')}}"></td></tr>
            <tr><th>メールアドレス</th><td><input type="email" name="email" value="{{old('email')}}"></td></tr>
            <tr><th>パスワード</th><td><input type="password" name="password" ></td></tr>
            <tr><th>パスワード確認</th><td><input type="password" name="password_confirmation" ></td></tr>
            {{-- 各種ボタン --}}
            <tr><th></th><td><input type="submit" value="登録"></td></tr>
            <tr><th><input type="button" onclick="location.href='/user/signin/twitter'" value="Twitterログイン"></th><td></td></tr>
        </table>
    </form>

@endsection
