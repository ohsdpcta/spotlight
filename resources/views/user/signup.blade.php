<!DOCTYPE html>
<head>
    <title>新規登録画面</title>
</head>



<h1>新規登録</h1>
    <form action="/user/signup" method="POST">
        <table>
            @csrf
            <tr><th>ユーザー名</th><td><input type="text" name="user_name" value="{{old('user_name')}}"></td></tr>
            <tr><th>メールアドレス</th><td><input type="email" name="email" value="{{old('email')}}"></td></tr>
            <tr><th>パスワード</th><td><input type="password" name="password" ></td></tr>
            <tr><th>パスワード確認</th><td><input type="password" name="password_Confirmation" ></td></tr>
            {{-- 各種ボタン --}}
            <tr><th></th><td><input type="submit" value="登録"></td></tr>
        </table>
    </form>

