@extends('layouts.main')

<meta charset="utf-8">
<title>トップ / Spotlight</title>

@section('user')

    <style>

    </style>

    <div>
        <br>
    </div>

    <div class="bg-dark pt-3 pb-3 mb-1 h-40">
        {{-- ページトップ部分 --}}
        <div class="container mb-1">
            {{-- spotlightロゴ --}}
            <h1 class="text-center text-light">SpotLight</h1>

            {{-- 検索フォーム --}}
            <form action="/user/search">
                @csrf
                <div class="row align-items-center text-center center">
                    <input type="search" name="search" value="" class="form-control col-md-11">
                    <button type="sumbit" class="btn btn-dark col-md-1"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="bg-secondary row mt-3 mb-3 col-md-10 col-md-offset-1">
                <p>ここにタグとかつける？</p>
            </div>

        </div>
    </div>

    <div class="bg-dark pt-3 pb-3 mb-1">
        <p class="text-center text-light">ここになんかせつめいとかいろいろかくかも</p>
    </div>

@endsection
