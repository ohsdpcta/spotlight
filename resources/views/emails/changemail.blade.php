<p>Spotlight</p>
<br>
<p>パスワード変更メールになります。以下のURLより</p>
<form action="changeedit" method="POST">
    @csrf

<a href="http://127.0.0.1:8000/user/{{Auth::id()}}/summary/changeedit/{{Auth::user()->email_verify_token}}">パスワード変更はこちら</a>
</form>
