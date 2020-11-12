
<html>

    <head>
        <title>@yield('title')</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

        <style>

        </style>

    </head>


    <header>
    </header>



    <body class="bg-dark parent">
        
        <div class="container align-items-center">
        <div class="row mt-5 mb-5"><br></div>
            <div class="row d-flex align-items-center">

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 center-block text-light">
                    <h1>SpotLightへようこそ！的な</h1>
                    <p>あなたの押しを見つけましょう</p>
                    <p>あなたのパフォーマンスの場は一か所に留まりません。</p>
                    <p>あなたが今、どこで何をしているのか。ファンに伝えましょう</p>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 center-block border bg-light">

                    <div class="">
                        <div class="col-md">
                            @yield('signup')
                        </div>
                    </div>

                    <div class="col-1"></div>
                    <br>
                </div>

            </div>

        </div>

    </body>

</html>
