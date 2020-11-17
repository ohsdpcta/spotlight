@extends('layouts/main')

{{-- --------------------------------------------------------------------------------------- --}}

{{-- ここ以下がmainのyieldに入る --}}
@section('user')

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

        <style>
            body {background-color: #2c2c2c;}
        </style>

    </head>

    <body>
                {{-- 全体 --}}
        <div class="container">
            <br>
            <div class="row">
                {{-- 左メニュー --}}
                <div class="bg-dark col-lg-3 col-md-3 col-sm-3 mb-1">
                    <h3 class="text-light mt-2">設定</h3>
                    <div class="form-group">
                        <p><a class="text-primary btn disabled" href="/user/{{request()->id}}/edit/">ユーザー情報</a></p>
                        <p><a class="text-primary btn" href="locate">ロケーション情報</a></p>
                        <p><a class="text-primary btn" href="goods">グッズ情報</a></p>
                        <p><a class="text-primary btn" href="sample">サンプル情報</a></p>
                    </div>
                </div>

                <div class="col-lg-1 col-md-1 col-sm-1"></div>

                {{-- 右フォーム --}}
                <div class="bg-dark col-lg-8 col-md-8 col-sm-8 pt-3 pr-3 pb-3 pl-3">
                    @yield('R_form')
                </div>

            </div>

            <br>

        </div>

    </body>

@endsection