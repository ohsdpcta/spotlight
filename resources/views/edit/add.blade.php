<!DOCTYPE HTML>
<html>
    <body>

        <h1>グッズ情報登録</h1>

    </body>
</html>
    
    <form action="add" method="post">
        @csrf
            グッズ名:<input type="text" name="name"><br>
        　　 URL:<input type="text" name="url"><br><br>
        <input type="submit" value="登録">
    </form>