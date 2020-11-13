@extends('layouts/main')

{{-- --------------------------------------------------------------------------------------- --}}

{{-- ここ以下がmainのyieldに入る --}}
@section('user')
    
<html>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

        <style>

        </style>

    </head>

    <body class="bg-dark">

        {{-- 全体 --}}
        <div class="container">
            <div class="row">

                {{-- 左メニュー --}}
                <div class="col-md-4">
                    @yield('L_menu')
                </div>

                {{-- 右フォーム --}}
                <div class="col-md-8">
                    @yield('R_form')
                </div>

            </div>
        </div>

    </body>

</html>

@endsection