<p>Spotlight</p>
<br>
<p>ソーシャルIDメールになります。以下のURLより</p>
<form action="socialedit" method="POST">
    @csrf

<a href="http://127.0.0.1:8000/user/{{Auth::id()}}/summary/socialedit/{{Auth::user()->email_verify_token}}">ソーシャルID変更はこちら</a>
</form>
