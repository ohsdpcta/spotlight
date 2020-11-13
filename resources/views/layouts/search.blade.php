@extends('layouts.main')

{{-- ------------------------------------------------------------------- --}}

{{-- ここ以下がmainレイアウトにはめ込まれる --}}
@section('user')

    <style>

    </style>

    {{-- ページトップ部分 --}}
    <div class="bg-dark pt-3 pb-3 mb-1 h-40">
        <div class="container mb-1">

            {{-- spotlightロゴ --}}
            <h3 class="text-center text-light">SpotLight</h3>

            {{-- 検索フォーム --}}
            <form action="/user/search" method="post">
                @csrf
                <div class="row align-items-center text-center center">
                    <input type="text" name="input" value="" class="form-control col-md-11" placeholder="Where do you want SPOTLIGHTING">
                    <button type="sumbit" class="btn btn-dark col-md-1" ><i class="fas fa-search"></i></button>
                </div>
            
            <div class="bg-secondary row mt-3 mb-3 col-md-10 col-md-offset-1">
                <p>ここにタグとかつける？</p>
            </div>

        </div>
    </div>

    <div>
        @yield('search_result')
    </div>


@endsection