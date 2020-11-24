@extends('layouts/signin')

<meta charset="utf-8">
<title>サインイン / Spotlight</title>

@section('signin')

<h1>サインイン</h1>
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
            <tr><th>メールアドレス or ユーザーID</th><td><input type="text" name="login_id" value="{{old('login_id')}}"></td></tr>
            <tr><th>パスワード</th><td><input type="password" name="password" ></td></tr>
            <tr><th>ログイン状態を保持</th><td><input type="checkbox" name="remember" value="true"></td></tr>
            {{-- 各種ボタン --}}
            <tr><th></th><td><input type="submit" value="ログイン"></td></tr>
            <tr><th><input type="button" onclick="location.href='/user/signin/twitter'" value="Twitterログイン"></th><td></td></tr>
        </table>
    </form>

@endsection