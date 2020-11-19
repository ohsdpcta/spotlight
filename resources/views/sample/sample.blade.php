@extends('layouts/user')

@section('content')

<html>
<head>
    <meta charset="utf-8">
    <title>サンプルページ</title>
</head>
<body>
    <p><a href="sample/add">サンプルリンクの追加</a></p><br>
    @if(count($data)==0)
        リンクが登録されていません
    @else
        <form action="sample/multi_del" method="GET">
            @csrf
        @foreach($data as $item)
            <p><input type="checkbox" name="check_sample[]" value="{{$item->id}}">&nbsp;
            <a href="{{ $item->url }}">{{ $item->name }}</a>
            <a href="/user/{{request()->id}}/sample/{{$item->id}}/del">削除
            <a href="/user/{{request()->id}}/sample/{{$item->id}}/edit">編集</p>
        @endforeach
            {{--{{request()->id()}}でURLのユーザーID取得  --}}
            <p><input type="submit" value="選択削除"></p>
        </form>
    @endif
</body>
</html>
@endsection
