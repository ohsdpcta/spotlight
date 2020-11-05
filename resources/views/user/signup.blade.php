@section('新規登録画面')

@endsection
@section('新規登録')
    <form action="{{ route('user.signup') }}" method="POST">
    <table>
        @csrf
        <tr><th>ユーザー名</th><td><input type="text" name="user_name" value="{{old('user_name')}}"></td></tr>
        <tr><th>メールアドレス</th><td><input type="email" name="email" value="{{old('email')}}"></td></tr>
        <tr><th>パスワード</th><td><input type="password" name="password" ></td></tr>
        <tr><th>パスワード確認</th><td><input type="password" name="password_Confirmation" ></td></tr>
    </table>
    </form>
@endsection
