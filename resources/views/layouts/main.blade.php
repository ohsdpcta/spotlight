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
            {{-- .navbar-brand-center {
                position: absolute;
                width: 100%;
                left: 0;
                top: 0;
                text-align:center;
                margin: auto;
            } --}}
            .footer {
                bottom: 0;
                width: 100%;
                /* Set the fixed height of the footer here */
                height: 100px;
                /* background-color: #3d3d3d; */
            }

        </style>
    </head>

    <header>
    </header>

    <body>
        <div class="h-100">
            {{-- ヘッダー --}}
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-0 mb-0 pt-0 pb-0 sticky-top">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand navbar-brand-center" href="/">Spotlight</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        {{-- 非ログイン時の処理 --}}
                        @if(!Auth::user())
                            <li class="nav-item active">
                                <a class="nav-link" href="/user/signin">sign in</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/signup">sign up</a>
                            </li>
                        {{-- ログイン時の処理 --}}
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/user/signout">sign out</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/{{ Auth::id() }}/profile">my page</a>
                            </li>
                        @endif
                    </ul>
                </div>

                {{-- indexのnavbarでは検索フォームを非表示 --}}
                @if(!(request()->path() == '/'))
                    <form class="form-inline mt-1 mb-1 align-right" action="/search" method="post">
                        @csrf
                        <input class="form-control mr-sm-1" type="search">
                        <button class="btn btn-primary" type="submit">検索</button>
                    </form>
                @endif

            </nav>

        </div>


        {{-- フッター --}}
        <footer class="footer sticky-bottom bg-dark">
            <div class="container">
                <p class="text-muted">ここに何か書く</p>
            </div>
        </footer>

    </body>

</html>
