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
        <!-- cssは移設しました -->
        <link rel="stylesheet" href="{{ asset('styles/main.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/sidebar.css') }}">
    </head>

    <header></header>

    <body>
        {{-- ヘッダー --}}
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-0 mb-0 pt-0 pb-0 sticky-top">

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

        <button type="button" class="btn_menu">開閉ボタン</button>
        <!-- サイドメニュー https://296.co.jp/article/09392320181809143-->
        <nav class="sidebar">
            <ul>
                <li><a href="/">メニュー1</a></li>
                <li><a href="/">メニュー2</a></li>
                <li><a href="/">メニュー3</a></li>
                <li><a href="/">メニュー4</a></li>
                <li><a href="/">メニュー5</a></li>
            </ul>
        </nav>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(function(){
                $('.btn_menu').click(function(){$('nav.sidebar').toggleClass('open');});
            })
        </script>




        {{-- フッター --}}
        <footer class="footer sticky-bottom bg-dark">
            <div class="container">
                <p class="text-muted">フッター</p>
            </div>
        </footer>

    </body>

</html>
