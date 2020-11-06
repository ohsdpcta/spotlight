<!DOCTYPE html>
<head>
    <title>サインイン画面</title>
</head>



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
            <tr><th>メールアドレス</th><td><input type="email" name="email" value="{{old('email')}}"></td></tr>
            <tr><th>パスワード</th><td><input type="password" name="password" ></td></tr>
            <tr><th>ログイン状態を保持</th><td><input type="checkbox" name="remeber" value="true"></td></tr>
            {{-- 各種ボタン --}}
            <input type="submit" value="ログイン">
        </table>
    </form>

