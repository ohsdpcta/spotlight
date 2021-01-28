@extends('layouts/search')

{{-- ---------------------------------------------------------------- --}}

{{-- ここ以下がsearchレイアウトにはめ込まれる --}}
@section('search_result')

    <head>
        <title>検索ページ</title>
    </head>

    <body>
        <div class="container">
            @foreach($result as $item)
                {{-- 背景の四角 --}}
                <div class="border-bottom row bg-white mt-1 pt-1 pb-1 pl-1 maru">
                    {{-- サムネ --}}
                    <div class="">
                        <img src="http://placehold.jp/50x50.png" class="rounded-circle">
                    </div>
                    {{-- リンク --}}
                    <div class="col-lg-8 col-md-11 col-sm-10 col-xs-7 align-items-center d-flex">
                        <button type="button" class="button btn border btn-block" onclick="location.href='/user/{{ $item->id }}/profile'">{{ $item->name }}</button>
                    </div>
                    {{-- タグ --}}
                    <div class="col-lg-4 col-md-1 col-sm-2 col-xs-5 align-items-center d-flex">
                        <form class="" method="get" action="/user/tag_search">
                            @csrf
                            <input class="form-control mr-sm-1" type="hidden" name="tag_id" value="{{ $item->id }}">
                            <button class="tag_btn rounded-pill border-primary px-3 mt-3" type="submit">#{{ $item->tag_name }}</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
        <br>
        {{-- {{$user->links()}} --}}
        {{-- {{ $result->links('vendor.pagination.sample-pagination') }} --}}
    </body>

@endsection