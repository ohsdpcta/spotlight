@extends('layouts.user')

@section('content')

<html>
<head>
    <meta charset="utf-8">
    <title>グッズ / Spotlight</title>

    <style>
        .imagetileview {
            overflow: hidden;
            text-align: center;
            /* display: flex; */
            /* flex-wrap: wrap; */
            /* position:relative; */
            /* padding-bottom:100%; */
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

        {{-- <ul class="row">
            @foreach ($data as $item)
                <li class="border col-4 imagetileview">
                    @if($item->picture)
                        <a href="{{ $item->url }}"><img src="{{ $item->picture }}" width="200" height="200" class="border rounded-circle"></a>
                    @else
                        <a href="{{ $item->url }}"><img src="http://placehold.jp/200x200.png" class="border"></a>
                    @endif
                </li>
            @endforeach
        </ul> --}}

        <div class="container">
            <div class="row">
                @foreach ($data as $item)
                <div class="col-4">
                    <div class="card imagetileview">
                        <div class="card-body">
                            @if($item->picture)
                                <a href="{{ $item->url }}"><img src="{{ $item->picture }}" width="200" height="200" class="card-img-top"></a>
                            @else
                                <a href="{{ $item->url }}"><img src="http://placehold.jp/200x200.png" class="border"></a>
                            @endif
                        </div>
                        <h5 class="card-text">{{ $item->name }}</h5>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{ $data->links('vendor.pagination.sample-pagination') }}

    </div>
    @endif
</body>

</html>
@endsection
