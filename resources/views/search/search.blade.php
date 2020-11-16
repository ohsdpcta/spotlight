<html>
<head>
    <title>検索ページ</title>
</head>
<body>
    @foreach($result as $item)
        <p>{{ $item->name }}</p>
    @endforeach
</body>
</html>