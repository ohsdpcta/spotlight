<html>
    <head>
        <meta charset="utf-8">
        <title>アカウント本登録　/　Spotlight</title>
    </head>
        <h1>ご登録した名前とメールアドレスのご確認をお願いいたします。</h1>
        <form action="confirmation" method="POST">
        <p>お名前:{{$user->name}}</p>
        <p>メールアドレス:{{$user->email}}</p>
        </form>
</html>


