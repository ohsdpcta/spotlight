<!DOCTYPE HTML>
<html>
    <body>
        <h1>ユーザー情報編集</h1>
            <p><a href="locate">ロケーション情報編集</a></p>
            <p><a href="goods">グッズ情報変更</a></p>
            <p><a href="sample">サンプル情報変更</a></p>
    </body>
</html>

</head>
    <body>
        <form action="/user/{{request()->id}}/profile" method="post">
            @csrf
                ユーザ名:<input type="text" name="name"><br>
                メールアドレス:<input type="text" name="mail"><br>
                パスワード:<input type="text" name="pass"><br>
            <input type="submit" value="登録">
        </form>
    </body>
</html>