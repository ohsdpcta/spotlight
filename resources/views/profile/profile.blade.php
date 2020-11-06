{{-- @section('profile') --}}
<html>
<head>
    <meta charset="utf-8">
    <title>プロフィールページ</title>
</head>
<body>
    @foreach($data as $item)
        {{ $item->content }}
    @endforeach
</body>
</html>
{{-- @endsection --}}