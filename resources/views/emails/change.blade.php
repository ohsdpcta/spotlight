<html>
    <head>
        <meta charset="utf-8">
        <title>パスワード変更メール送信ページ　/　Spotlight</title>
    </head>

        <p>パスワード変更メールの送信を行いますか？</p>
    <form action="changemail" method="POST">
        @csrf
            <label><input type="submit" name="send" value="送信"> </label>

        </form>
</html>
