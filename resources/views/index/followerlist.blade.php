<html>
<head>
    <meta charset="utf-8">
    <title>フォロワー / Spotlight</title>
</head>
<body>
    @if(count($data)==0)
        フォロワーがいません
    @else
        <ul class="list-group">
            @foreach ($data as $item)
                <li class="list-group-item">
                <a href="{{ $item->url }}">{{ $item->follower_id }}</a>
                </li>
            @endforeach
        </ul>
        {{ $data->links('vendor.pagination.sample-pagination') }}
    @endif
</body>
</html>