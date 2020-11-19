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
        @foreach($data as $item)
            <a href="{{ $item->url }}">{{ $item->name }}</a></br>
        @endforeach
    @endif
</body>
</html>
@endsection
