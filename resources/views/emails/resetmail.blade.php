
<h3>Spotlight</h3>
<br>
<form action="donemail" method="POST">
    <p>パスワードリセットメールです。以下のURLから変更をしてください</p><br>
    <p>こちらのメールには返信不要です。</p>
    @csrf

    <a href="{{ config('services.host.url') }}/user/signin/passform/{{$email_token}}">変更はこちら</a>

</form>
