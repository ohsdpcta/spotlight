<html>

    <head>
        <title>@yield('title')</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">


        <style>
            header {
                background-color: blue;
            }
            header h1 {
                font-size: small;
                text-align:center
            }

            body {
                background-color: #858585;
                /* margin-top: 50px; */
            }

            .top {
                padding: 0.5em 1em;
                margin: 2em 0;
                color: #2c2c2f;
                background: #ffffff;/*背景色*/
                align-content: center;
            }
            .top p {
                margin: 0; 
                padding: 0;
            }

            .tab {
                padding: 0.5em 1em;
                margin: 2em 0;
                color: #2c2c2f;
                background: #ffffff;/*背景色*/
            }
            .tab p {
                margin: 0; 
                padding: 0;
            }
            .navbar-brand-center {
                position: absolute;
                width: 100%;
                left: 0;
                top: 0;
                text-align:center;
                margin: auto;
            }
        
        </style>
    </head>

    <header>
    </header>

    <body>

        <nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-0 mb-0 pt-0 pb-0 sticky-top">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand navbar-brand-center" href="#">Spotlight</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item activie">
                        <a class="nav-link" href="#">sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">sign up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">my page</a>
                    </li>
                </ul>
            </div>

            <form class="form-inline mt-1 mb-1 align-right">
                <input class="form-control mr-sm-1" type="search">
                <button class="btn btn-primary" type="submit">検索</button>
            </form>

        </nav>
        

        <div class="container">

            <div class="top">
                <img src="http://placehold.jp/200x200.png" class="rounded-circle">
                <h1>zyugemu zyugemu</h1>
            </div>

            <div class="tab w-100 nav-justified">
                <ul class="nav nav-tabs">

                    {{-- @if ($tekitou == 'profile') --}}
                    <li class="nav-item">
                        <a href="spotlight/user/:id/profile" class="nav-link active">プロフィール</a>
                    </li>
                    {{-- @else
                    <li class="nav-item">
                        <a href="spotlight/user/:id/profile" class="nav-link ">プロフィール</a>
                    </li>
                    @endif --}}

                    <li class="nav-item">
                        <a href="spotlight/user/:id/locate" class="nav-link">ロケーション</a>
                    </li>
                    <li class="nav-item">
                        <a href="spotlight/user/:id/goods" class="nav-link">グッズ</a>
                    </li>
                    <li class="nav-item">
                        <a href="spotlight/user/:id/sample" class="nav-link">サンプルリンク</a>
                    </li>
                </ul>

                <div>@yield('profile')</div>
                
            </div>

        </div>
        

    </body>

</html>