<html>
<head>
    <title>検索ページ</title>
</head>
<body>
    @foreach($result as $item)
        #<p>{{ $item->name }}</p>
        <a href=" /user/{id}/profile">{{ $item->name }}</a>
    @endforeach
</body>
</html>