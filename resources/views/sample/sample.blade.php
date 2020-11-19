@extends('layouts.user')

@section('content')
<html>
<head>
    <meta charset="utf-8">
    <title>サンプルページ</title>
</head>
<body>
    @if(count($data)==0)
        リンクが登録されていません
    @else
        <ul class="list-group">
            @foreach ($data as $item)
                <li class="list-group-item">
                <a href="{{ $item->url }}">{{ $item->name }}</a>
                </li>
            @endforeach
        </ul>
        {{ $data->links('vendor.pagination.sample-pagination') }}
    @endif
</body>
</html>
@endsection