@extends('layouts/search')

{{-- ---------------------------------------------------------------- --}}

{{-- ここ以下がsearchレイアウトにはめ込まれる --}}
@section('search_result')

    <head>
        <title>検索ページ</title>
    </head>

    <body>
        <div class="container">
            @foreach($users as $user)
                {{-- 背景の四角 --}}
                <div class="border-bottom row bg-white mt-1 pt-1 pb-1 pl-1 maru">
                    {{-- サムネ --}}
                    <div class="">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" width="50" height="50" class="rounded-circle">
                        @else
                            <img src="http://placehold.jp/50x50.png" class="rounded-circle">
                        @endif
                    </div>
                    {{-- リンク --}}
                    <div class="col-8 align-items-center d-flex">
                        <button type="button" class="button btn border btn-block" onclick="location.href='/user/{{ $user->id }}/profile'">{{ $user->name }}</button>
                    </div>
                    {{-- ショートプロフィール --}}
                    <div class="pl-5 col-10 align-items-center d-flex">
                        @if($user->sprofile)
                            {{ $user->sprofile->scomment }}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <br>
        {{ $users->links('vendor.pagination.sample-pagination') }}
    </body>

@endsection