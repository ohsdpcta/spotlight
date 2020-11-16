<!DOCTYPE HTML>
<html>
    <body>
        <h1>グッズ情報編集</h1>
        <p><a href="/user/{{request()->id}}/edit/">戻る</a></p>
    </body>
</html>

<body>
    <p><a href="/user/{{request()->id}}/edit/goods/add">商品の追加</a></p>

    @foreach($data as $item)
        <p><input type="checkbox" name="check" value="{{$item->id}}">
        <a href="{{ $item->url }}">{{ $item->name }}</a>
        <a href="/user/{{request()->id}}/edit/goods/{{$item->id}}/del">削除</p>
    @endforeach
        {{--{{request()->id()}}でURLのユーザーID取得  --}}
        <p><a href="/user/{{request()->id}}/goods/multi_del">選択削除</p>
</body>
</html>
