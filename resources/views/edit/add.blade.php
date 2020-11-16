<!DOCTYPE HTML>
<html>
    <body>

        <h1>グッズ情報登録</h1>
        <p><a href="/user/{{request()->id}}/edit/">戻る</a></p>
    </body>
</html>
<body>
    <form action="/user/{{request()->id}}/edit/goods/add" method="post">
        @csrf
            グッズ名:<input type="text" name="name"><br>
        　  URL:<input type="text" name="url"><br>
        <input type="submit" value="登録">
    </form>
</body>