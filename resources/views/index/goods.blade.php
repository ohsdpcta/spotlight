@extends('layouts.user')

@section('content')

<html>
<head>
    <meta charset="utf-8">
    <title>グッズ / Spotlight</title>
</head>
<body>
    @if(count($data)==0)
        リンクが登録されていません
    @else
        <ul class="border border-top-0 rounded-bottom px-4 py-3">
            @foreach ($data as $item)
                <li>
                    <a href="{{ $item->url }}">{{ $item->name }}</a>
                </li>
            @endforeach
        </ul>
        {{ $data->links('vendor.pagination.sample-pagination') }}
    @endif
</body>
</html>
@endsection
