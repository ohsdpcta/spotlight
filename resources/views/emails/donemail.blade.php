
<p>Spotlight</p>
<br>
<form action="donemail" method="POST">
    <p>メールアドレスの変更申請が完了しました。以下のURLから変更を確定してください</p><br>
    <p>こちらのメールには返信不要です。</p>
    @csrf
    <a href="{{ config('services.host.url') }}/user/{{Auth::id()}}/summary/account/donemail/{{$email_token}}">変更確定はこちら</a>

</form>



