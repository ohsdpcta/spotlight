@extends('layouts.user')

@section('content')

<html>

<head>
    <meta charset="utf-8">
    <title>プロフィール / Spotlight</title>
</head>

<body>
    <div class="border border-top-0 rounded-bottom px-4 py-3">
        {{ Illuminate\Mail\Markdown::parse(e($data->content)) }}
    </div>
</body>

</html>

@endsection
