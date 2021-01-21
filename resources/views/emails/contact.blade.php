<p>この度は、ストリートアーティストマッチングサイト【Spotlight】に<br>
    ご登録いただき、誠にありがとうございます。</p>
                <p>
                    ご本人様確認のため、以下のURLにアクセスし、<br>
                    アカウントの本登録を完了させてください。
                </p>
        <form action="/user/emails/conteact" method="POST">
            @csrf
        <p>{{$user->email}}</p>
                <a href="http://127.0.0.1:8000/user/emails/authentication">アカウントの本登録はこちら</a>
        </form>



