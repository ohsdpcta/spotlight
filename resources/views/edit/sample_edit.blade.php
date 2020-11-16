<!DOCTYPE HTML>
<html>
    <body>

        <h1>サンプル情報編集</h1>
        <p><a href="/user/{{request()->id}}/edit/">戻る</a></p>
    </body>
</html>

</head>
    <body>
        <p><a href="sample/add">サンプルリンクの追加</a></p>
        @foreach($data as $item)
            <a href="{{ $item->url }}">{{ $item->name }}</a>　
            <a href="/user/{{request()->id}}/edit/goods/{{$item->id}}/del">削除</a>
        @endforeach
    </body>
</html>
