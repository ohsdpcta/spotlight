
<p>Spotlight</p>
<br>
<p>メールアドレス変更メールになります。以下のURLより</p>
<form action="mailedit" method="POST">
    @csrf

<a href="{{ config('services.host.url') }}/user/{{Auth::id()}}/summary/mailedit/{{Auth::user()->email_verify_token}}">メールアドレス変更はこちら</a>
</form>
