@extends('layouts/main')
@section('user')

<html>

    <head>
        <title>@yield('title')</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('styles/main.css') }}">

        <style>
        </style>

    </head>


    <header>
    </header>



    <body class="parent">

        <div class="container align-items-center">
        <div class="row mt-5 mb-5"><br></div>
            <div class="row d-flex align-items-center">

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 center-block text-dark">
                    <h1>Welcome Back!</h1>
                    <p>ここはsignin画面です</p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 center-block">

                    <div class="">
                        <div class="col-md">
                            @yield('signin')
                        </div>
                    </div>

                    <div class="col-1"></div>
                    <br>
                </div>

            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>

    </body>

</html>

@endsection