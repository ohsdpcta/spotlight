<html>
    <head>
        <meta charset="utf-8">
        <title>アカウント本登録　/　Spotlight</title>
    </head>
        <p>ご登録した名前とメールアドレスのご確認をお願いいたします。</p>
        <form action="confirmation" method="POST">
        <p>お名前:{{$user->name}}</p>
        <p>メールアドレス:{{$user->email}}</p>
        <label><input type="button" name="conf" value="認証"></label>
        </form>
</html>


