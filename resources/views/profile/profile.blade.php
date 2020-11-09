@extends('layouts/main')

@section('content') 

<html>
<head>
    <meta charset="utf-8">
    <title>プロフィールページ</title>
</head>
<body>
    @foreach($data as $item)
        {{ $item->content }}
    @endforeach

    <a href="profile/edit">プロフィールの修正</a>
</body>
</html>
@endsection