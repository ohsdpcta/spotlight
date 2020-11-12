@extends('layouts/user')

@section('content')

<html>

<head>
    <meta charset="utf-8">
    <title>プロフィールページ</title>
</head>

<body>
    <p><a href="profile/edit">プロフィールの修正</a></p>
    {{ $data->content }}
</body>

</html>

@endsection