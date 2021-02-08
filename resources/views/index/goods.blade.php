@extends('layouts.user')

@section('content')

<html>
<head>
    <meta charset="utf-8">
    <title>グッズ / Spotlight</title>

    <style>
        .imagetileview {
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
            position:relative;
            padding-bottom:100%;
        }
        .image img{
  position:absolute;
}
    </style>
</head>

<body>
    @if(count($data)==0)
        リンクが登録されていません
    @else
    <div class="border border-top-0 rounded-bottom px-4 py-3">

        <ul class="row">
            @foreach ($data as $item)
                <li class="border col-4 imagetileview">
                    {{-- <a href="{{ $item->url }}">{{ $item->name }}</a> --}}
                    @if($item->picture)
                        <a href="{{ $item->url }}"><img src="{{ $item->picture }}" class="border"></a>
                    @else
                        <a href=""><img src="http://placehold.jp/200x200.png" class="border"></a>
                    @endif
                </li>
            @endforeach
        </ul>

        {{ $data->links('vendor.pagination.sample-pagination') }}

    </div>
    @endif
</body>

</html>
@endsection
