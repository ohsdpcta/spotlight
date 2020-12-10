@extends('layouts.user')

@section('content')

<html>

<head>
    <meta charset="utf-8">
    <title>プロフィール / Spotlight</title>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
</head>

<body>
    {{ Illuminate\Mail\Markdown::parse(e($data->content)) }}
</body>

</html>

@endsection