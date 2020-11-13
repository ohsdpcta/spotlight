<!DOCTYPE HTML>
<html>
    <body>

        <h1>グッズ情報編集</h1>

    </body>
</html>

<body>
    <p><a href="goods/add">商品の追加</a></p><br>

    @foreach($data as $item)
        <p><a href="{{ $item->url }}">{{ $item->name }}　　
        </a><a href="/user/{{ $item->id }}/goods/del">削除</p>
    @endforeach
</body>
</html>
