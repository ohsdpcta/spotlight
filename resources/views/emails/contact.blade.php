<p>この度は、ストリートアーティストマッチングサイト【Spotlight】に<br>
    ご登録いただき、誠にありがとうございます。</p>
                <p>
                    ご本人様確認のため、以下のURLにアクセスし、<br>
                    アカウントの本登録を完了させてください。
                </p>
        <form action="/user/emails/conteact" method="POST">
            @csrf

        <a href="{{ config('services.host.url') }}/user/emails/authentication/{{$user_data}}">アカウントの本登録はこちら</a>
        </form>




