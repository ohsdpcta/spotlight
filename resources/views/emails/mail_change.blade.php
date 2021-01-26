<html>
    <head>
        <meta charset="utf-8">
        <title>メールアドレス変更メール送信ページ　/　Spotlight</title>
    </head>

        <p>メールアドレス変更メールの送信を行いますか？</p>
    <form action="mail_email" method="POST">
        @csrf
            <label><input type="submit" name="send" value="送信"> </label>

        </form>
</html>
