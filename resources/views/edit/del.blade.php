<!DOCTYPE HTML>
<html>
    <body>

        <h1>グッズ情報削除ページ</h1>

    </body>
</html>

    <form action="del" method="post">
    @csrf
        @foreach($data as $item)
            グッズ: {{ $item->name }}<br>
        　　 URL: {{ $item->url }}<br><br>
        @endforeach
        <input type="submit" value="削除">このグッズを削除します。よろしいですか？
    </form>