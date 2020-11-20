@extends('layouts/search')

{{-- ---------------------------------------------------------------- --}}

{{-- ここ以下がsearchレイアウトにはめ込まれる --}}
@section('search_result')

    <head>
        <title>検索ページ</title>
    </head>

    <style>
        .maru {
            /* 左上　右上　右下　左下 */
            border-radius: 50px 10px 10px 50px;
        }
    </style>

    <body>
        <div class="container">
            @foreach($result as $item)
                {{-- 背景の四角 --}}
                <div class="row bg-dark mt-1 pt-1 pb-1 pl-1 maru">
                    {{-- サムネ --}}
                    <div class="">
                        <img src="http://placehold.jp/50x50.png" class="rounded-circle">
                    </div>
                    {{-- リンク --}}
                    <div class="col-lg-11 col-md-11 col-sm-10 col-xs-7 align-items-center d-flex">
                        <button type="button" class="btn btn-secondary btn-block" onclick="location.href='/user/{{$item->id}}/profile'">{{ $item->name }}</button>
                        {{-- <p><a class="text-light" href="/user/{{$item->id}}/profile">{{ $item->name }}</a></p> --}}
                    </div>
                </div>
            @endforeach
        </div>
        <br>
        {{ $result->links('vendor.pagination.sample-pagination') }}
    </body>

@endsection