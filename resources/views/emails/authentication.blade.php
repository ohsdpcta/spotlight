<html>
    <head>
        <meta charset="utf-8">
        <title>アカウント本登録　/　Spotlight</title>
    </head>


        <p>ご登録した名前とメールアドレスのご確認をお願いいたします。</p>
        <form action="/user/emails/confirmation" method="POST">
        @csrf
        <p>お名前:{{$users->name}}</p>
        <p>メールアドレス:{{$users->email}}</p>
        <label><input type="submit" name="conf" value="認証"></label>
        </form>




</html>


