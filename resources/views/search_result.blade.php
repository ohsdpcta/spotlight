@extends('layouts/search')

{{-- ---------------------------------------------------------------- --}}

{{-- ここ以下がsearchレイアウトにはめ込まれる --}}
@section('search_result')

    <head>
        <title>検索ページ</title>
    </head>

    <body>
        <div class="container">
            @foreach($user as $item)
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
                </div>
            @endforeach
        </div>
        <br>
        {{-- {{$user->links()}} --}}
        {{ $user->links('vendor.pagination.sample-pagination') }}
    </body>

@endsection