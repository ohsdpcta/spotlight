<!DOCTYPE HTML>
<html>
    <body>

        <h1>グッズ情報削除ページ</h1>
        <p><a href="/user/{{request()->id}}/edit/">戻る</a></p>
    </body>
</html>

    <form action="del" method="post">
    @csrf
        グッズ: {{ $data->name }}<br>
        URL: {{ $data->url }}<br><br>
        <input type="submit" value="削除">このグッズを削除します。よろしいですか？
    </form>