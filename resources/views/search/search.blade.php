<html>
<head>
    <title>検索ページ</title>
</head>
<body>
    @foreach($result as $item)
        <p><a href=" /user/{{$item->id}}/profile">{{ $item->name }}</a></p>
    @endforeach
</body>
</html>