@extends('layouts/main')

{{-- --------------------------------------------------------------------------------------- --}}

{{-- ここ以下がmainのyieldに入る --}}
@section('user')

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

        <style>
            body {background-color: #ffffff;}
        </style>

    </head>

    <body>
                {{-- 全体 --}}
        <div class="container">
            <br>
            <div class="row">
                {{-- 左メニュー --}}
                <div class="col-lg-3 col-md-3 col-sm-3 py-1 bg-light">
                    <h3 class="text-dark mt-2">設定</h3>
                    <div class="form-group">
                        <p><a class="text-primary btn @if(request()->is('*/account*')) disabled @endif" href="/user/{{Auth::id()}}/summary/account/">アカウント情報</a></p>
                        <p><a class="text-primary btn @if(request()->is('*/profile*')) disabled @endif" href="/user/{{Auth::id()}}/summary/profile">プロフィール情報</a></p>
                        <p><a class="text-primary btn @if(request()->is('*/smallprofile*')) disabled @endif" href="/user/{{Auth::id()}}/summary/smallprofile/">ひと言コメント編集</a></p>
                        @if(Auth::user()->role == "Performer")
                            <p><a class="text-primary btn @if(request()->is('*/tag*')) disabled @endif" href="/user/{{Auth::id()}}/summary/tag/">タグ編集</a></p>
                            <p><a class="text-primary btn @if(request()->is('*/locate*')) disabled @endif" href="/user/{{Auth::id()}}/summary/locate/">ロケーション情報</a></p>
                            <p><a class="text-primary btn @if(request()->is('*/goods*')) disabled @endif" href="/user/{{Auth::id()}}/summary/goods/">グッズ情報</a></p>
                            <p><a class="text-primary btn @if(request()->is('*/sample*')) disabled @endif" href="/user/{{Auth::id()}}/summary/sample/">サンプル情報</a></p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-1 col-md-1 col-sm-1"></div>

                {{-- 右フォーム --}}
                <div class="col-lg-8 col-md-8 col-sm-8 p-3 bg-light">
                    @yield('R_form')
                </div>

            </div>

            <br>

        </div>

    </body>

@endsection
