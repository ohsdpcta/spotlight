@extends('layouts/main')

@section('content')

<html>
<head>
    <meta charset="utf-8">
    <title>プロフィールページ</title>
</head>
<body>
    <input type="button" onclick="location.href='/user/{{ $data->user_id }}/follow'" value="フォロー">
    <input type="button" onclick="location.href='/user/{{ $data->user_id }}/unfollow'" value="フォロー解除">
    <p><a href="profile/edit">プロフィールの修正</a></p>
    {{ $data->content }}
</body>
</html>

@endsection