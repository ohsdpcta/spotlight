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
                        <p><a class="text-primary btn @if(request()->is('*account')) disabled @endif" href="/user/{{request()->id}}/summary/account/">アカウント情報</a></p>
                        <p><a class="text-primary btn @if(request()->is('*profile')) disabled @endif" href="/user/{{request()->id}}/summary/profile">プロフィール情報</a></p>
                        <p><a class="text-primary btn @if(request()->is('*locate')) disabled @endif" href="/user/{{request()->id}}/summary/locate/">ロケーション情報</a></p>
                        <p><a class="text-primary btn @if(request()->is('*goods')) disabled @endif" href="/user/{{request()->id}}/summary/goods/">グッズ情報</a></p>
                        <p><a class="text-primary btn @if(request()->is('*sample')) disabled @endif" href="/user/{{request()->id}}/summary/sample/">サンプル情報</a></p>
                    </div>
                </div>

                <div class="col-lg-1 col-md-1 col-sm-1"></div>

                {{-- 右フォーム --}}
                <div class="bg-dark col-lg-8 col-md-8 col-sm-8 pt-3 pr-3 pb-3 pl-3">
                    @yield('R_form')
                    <font size="" color="white"><h3>プロフィール編集</h3></font>
                    <div class="pt-3">
                        <form action="/user/{{request()->id}}/summary/profile" method="post">
                            @csrf
                            <label><font size="" color="white">あなたを知らせるためのプロフィールを記入することができます。</font></label>
                            <textarea name="content" cols="80" rows="5">{{ $data->content }}</textarea>
                            <input type="submit" value="修正">
                        </form>
                    </div>

                </div>

            </div>

            <br>

        </div>

    </body>

@endsection