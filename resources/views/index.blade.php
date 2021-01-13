@extends('layouts.main')

<meta charset="utf-8">
<title>トップ / Spotlight</title>

@section('user')

    <style>
        .jumbotron1 {
            background:url(https://images.unsplash.com/photo-1513364776144-60967b0f800f?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1951&q=80)
            center no-repeat;
            background-size: cover;
            }
        .jumbotron2 {
            background:url(https://images.unsplash.com/photo-1510915361894-db8b60106cb1?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80)
            center no-repeat;
            background-size: cover;
            }
        .shadow_test{
            text-shadow: 0px 0px 5px #ffffff;
            }
    </style>

    <div class="pt-3 pb-3 mb-1">
        {{-- ページトップ部分 --}}
        <div class="borde container mb-1">
            {{-- spotlightロゴ --}}
            <h1 class="text-center text-primary">SpotLight</h1>

            {{-- 検索フォーム --}}
            <form action="/user/search">
                @csrf
                <div class="row align-items-center text-center center">
                    <input type="search" name="search" value="" class="form-control col-md-11">
                    <button type="sumbit" class="btn col-md-1"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="border row mt-3 mb-3 col-md-10 col-md-offset-1">
                <p>ここにタグとかつける？</p>
            </div>

        </div>
    </div>

    <div class="pt-3 pb-3 mb-1 jumbotron1">
        <div class="col-6 mr-auto shadow_test text-black">
            <br>
            <br>
            <br>
            <br>
            <h3 class="text-center">こんにちは！</h3>
            <h3 class="text-center">SpotLightはストリートパフォーマーとそのファンを繋ぐ</h3>
            <h3 class="text-center">ハブとなる場所です</h3>
            <br>
            <br>
            <br>
        </div>
    </div>

    <div class="pt-3 pb-3 mb-1 jumbotron2">
        <div class="col-6 ml-auto shadow_test text-light">
            <br>
            <br>
            <br>
            <br>
            <h3 class="text-center">ストリートとインターネットの場所を結びつけ</h3>
            <h3 class="text-center">アーティストを”フォロー”しましょう</h3>
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>

@endsection
