<html>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="/common/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
        <script src="/common/js/bootstrap.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
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
                background-color: #2c2c2c;
                /* margin-top: 50px; */
            }

            .top {
                padding: 0.5em 1em 0; /*上 左右 下*/
                margin: 2em 0 0;
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
            .footer {
                bottom: 0;
                width: 100%;
                /* Set the fixed height of the footer here */
                height: 100px;
                /* background-color: #3d3d3d; */
            }
            .nav-justified {
                display: table;
                table-layout: fixed;
                width: 100%;
            }
            
/* -------------------------------------------------------------------- */

            @import url('https://fonts.googleapis.com/css?family=Varela+Round');
            html, body {
                overflow-x: hidden;
                height: 100%;
            }
            body {
                /* background: #fff; */
                padding: 0;
                margin: 0;
                /* font-family: 'Varela Round', sans-serif; */
            }
            /* .header {
                display: block;
                margin: 0 auto;
                width: 100%;
                max-width: 100%;
                box-shadow: none;
                background-color: #FC466B;
                position: fixed;
                height: 60px!important;
                overflow: hidden;
                z-index: 10; */
            }
            .mainInner{
                display: table;
                height: 100%;
                width: 100%;
                text-align: center;
            }
            .mainInner div{
                display:table-cell;
                vertical-align: middle;
                font-size: 3em;
                font-weight: bold;
                letter-spacing: 1.25px;
            }
            #sidebarMenu {
                height: 100%;
                /* position: fixed; */
                left: 0;
                width: 250px;
                margin-top: 60px;
                transform: translateX(-250px);
                transition: transform 250ms ease-in-out;
                background: linear-gradient(180deg, #FC466B 0%, #3F5EFB 100%);
            }
            .sidebarMenuInner{
                margin:0;
                padding:0;
                border-top: 1px solid rgba(255, 255, 255, 0.10);
            }
            .sidebarMenuInner li{
                list-style: none;
                color: #fff;
                text-transform: uppercase;
                font-weight: bold;
                padding: 20px;
                cursor: pointer;
                border-bottom: 1px solid rgba(255, 255, 255, 0.10);
            }
            .sidebarMenuInner li span{
                display: block;
                font-size: 14px;
                color: rgba(255, 255, 255, 0.50);
            }
            .sidebarMenuInner li a{
                color: #fff;
                text-transform: uppercase;
                font-weight: bold;
                cursor: pointer;
                text-decoration: none;
            }
            input[type="checkbox"]:checked ~ #sidebarMenu {
                transform: translateX(0);
            }

            input[type=checkbox] {
                transition: all 0.3s;
                box-sizing: border-box;
                display: none;
            }
            .sidebarIconToggle {
                transition: all 0.3s;
                box-sizing: border-box;
                cursor: pointer;
                position: absolute;
                z-index: 99;
                height: 100%;
                width: 100%;
                top: 22px;
                left: 15px;
                height: 22px;
                width: 22px;
            }
            .spinner {
                transition: all 0.3s;
                box-sizing: border-box;
                position: absolute;
                height: 3px;
                width: 100%;
                background-color: #fff;
            }
            .horizontal {
                transition: all 0.3s;
                box-sizing: border-box;
                position: relative;
                float: left;
                margin-top: 3px;
            }
            .diagonal.part-1 {
                position: relative;
                transition: all 0.3s;
                box-sizing: border-box;
                float: left;
            }
            .diagonal.part-2 {
                transition: all 0.3s;
                box-sizing: border-box;
                position: relative;
                float: left;
                margin-top: 3px;
            }
            input[type=checkbox]:checked ~ .sidebarIconToggle > .horizontal {
                transition: all 0.3s;
                box-sizing: border-box;
                opacity: 0;
            }
            input[type=checkbox]:checked ~ .sidebarIconToggle > .diagonal.part-1 {
                transition: all 0.3s;
                box-sizing: border-box;
                transform: rotate(135deg);
                margin-top: 8px;
            }
            input[type=checkbox]:checked ~ .sidebarIconToggle > .diagonal.part-2 {
                transition: all 0.3s;
                box-sizing: border-box;
                transform: rotate(-135deg);
                margin-top: -9px;
            }

/* ------------------------------------------------------------------------ */

        </style>
    </head>

    <header>
    </header>

    <body>
        {{-- ヘッダー --}}
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-0 mb-0 pt-0 pb-0 sticky-top">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4" aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

{{-- ---------------------------------------------------------------------------------- --}}

{{-- 
        サイドバーボタン
        <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu">
        <label for="openSidebarMenu" class="sidebarIconToggle">
            <div class="spinner diagonal part-1"></div>
            <div class="spinner horizontal"></div>
            <div class="spinner diagonal part-2"></div>
        </label>

        <div id="sidebarMenu">
            <ul class="sidebarMenuInner">
            <li>Jelena Jovanovic <span>Web Developer</span></li>
            <li><a href="https://vanila.io" target="_blank">Company</a></li>
            <li><a href="https://instagram.com/plavookac" target="_blank">Instagram</a></li>
            <li><a href="https://twitter.com/plavookac" target="_blank">Twitter</a></li>
            <li><a href="https://www.youtube.com/channel/UCDfZM0IK6RBgud8HYGFXAJg" target="_blank">YouTube</a></li>
            <li><a href="https://www.linkedin.com/in/plavookac/" target="_blank">Linkedin</a></li>
            </ul>
        </div>
 --}}

{{-- ------------------------------------------------------------------------------------------------------- --}}

            <a class="navbar-brand navbar-brand-center" href="/">Spotlight</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    {{-- 非ログイン時の処理 --}}
                    @if(!Auth::user())
                        @if(request()->path() == 'user/signin')
                            <li class="nav-item active">
                                <a class="nav-link" href="/user/signin">sign in</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/signup">sign up</a>
                            </li>
                        @elseif(request()->path() == 'user/signup')
                            <li class="nav-item">
                                <a class="nav-link" href="/user/signin">sign in</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="/user/signup">sign up</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/user/signin">sign in</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/signup">sign up</a>
                            </li>
                        @endif
                    {{-- ログイン時の処理 --}}
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/user/signout">sign out</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/{{ Auth::id() }}/@if(request()->is('*profile'))profile\
                                @elseif(request()->is('*locate'))locate\
                                @elseif(request()->is('*goods'))goods\
                                @elseif(request()->is('*sample'))sample\
                                @else()profile\
                                @endif"
                            >my page</a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- indexのnavbarでは検索フォームを非表示 --}}
            @if(!(request()->path() == '/'))
                <form class="form-inline mt-1 mb-1 align-right" action="/user/search">
                    @csrf
                    <input class="form-control mr-sm-1" type="search" name="search">
                    <button class="btn btn-primary" type="submit">検索</button>
                </form>
            @endif

        </nav>
        @if(session('flash_message'))
            <div class="alert text-center py-3 my-0" style="color:#fff; background-color:#414579">
                {{ session('flash_message') }}
            </div>
        @endif

        @yield('user')

{{-- ---------------------------------------------------------------------------------- --}}




{{-- -------------------------------------------------------------------------------------- --}}

        {{-- フッター --}}
        <footer class="footer sticky-bottom bg-dark">
            <div class="container">
                <p class="text-muted">フッター</p>
            </div>
        </footer>

    </body>

</html>
