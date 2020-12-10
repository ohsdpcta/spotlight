@extends('layouts.user')

@section('content')

<html>

<head>
    <meta charset="utf-8">
    <title>プロフィール / Spotlight</title>
</head>

<body>
<<<<<<< HEAD
    {{ Illuminate\Mail\Markdown::parse(e($data->content)) }}
=======
    {{ $data->content }}
>>>>>>> develop
</body>

</html>

@endsection