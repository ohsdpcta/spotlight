<html>
<head>
    <title>検索ページ</title>
</head>
<body>
    <form action="/search" method="post">
        @csrf
        <input type="text" name="input" value="">
        <button type="sumbit">検索</button>
    </form>
</body>
</html>