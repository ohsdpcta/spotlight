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
        <nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom mt-0 mb-0 pt-0 pb-0 sticky-top">

            <a class="navbar-brand navbar-brand-center text-dark" href="/">Spotlight</a>
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
            <div class="alert alert-primary text-center py-3 my-0">
                {{ session('flash_message') }}
            </div>
        @endif

        <button type="button" class="btn_menu"><i class="fas fa-bars"></i></button>
        <!-- サイド(ドロワー)メニュー https://296.co.jp/article/09392320181809143-->
        <nav class="border container sidebar text-dark">
            <br>
            {{-- 非ログイン時 --}}
            @if(!Auth::user())
            <ul>
                <li class="mt-2"><a href="/user/signup">signup</a></li>
                <li class="mt-2"><a href="/user/signin">signin</a></li>
            </ul>
            {{-- ログイン時 --}}
            @else
                <ul id="accordion_menu">
                    {{-- フォロー一覧 --}}
                    <li>
                        <a data-toggle="collapse" href="#menu01" aria-controls="#menu01" aria-expanded="false">フォロー</a>
                    </li>
                    <ul id="menu01" class="collapse" data-parent="#accordion_menu">
                        <?php $data = UserClass::getFollowList(Auth::user()->id) ?>
                        @if(count($data)===0)
                            <li class="text-dark">フォロー中のユーザーがいません<li>
                        @else
                        {{-- 項 --}}
                            @foreach($data as $item)
                                <li>
                                    <a href="/user/{{$item->target_id}}/profile">
                                        @if(UserClass::getUser($item->target_id)->avatar)
                                            <img src="{{ UserClass::getUser(request()->id)->avatar }}" width="200" height="200" class="rounded-circle">
                                        @else
                                            <img src="http://placehold.jp/30x30.png" class="rounded-circle">
                                        @endif
                                        {{UserClass::getUser($item->target_id)->name}}
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </ul>
            @endif

        </nav>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(function(){
                $('.btn_menu').click(function(){$('nav.sidebar').toggleClass('open');});
                $('.btn_menu').click(function(){$('button.btn_menu').toggleClass('open');});
            })
        </script>

        @yield('user')

{{-- ---------------------------------------------------------------------------------- --}}

        {{-- フッター --}}
        <footer class="footer sticky-bottom bg-light">
            <div class="container">
                <div class="row pt-2 pb-2 pr-2 pl-2">
                    <div class="col-4 text-muted">
                        <h5>about us...</h5>
                        <p>D'où Venons Nous Que Sommes Nous Où Allons Nous</p>
                    </div>
                    <div class="col-4 text-muted">
                        <h5>navigation</h5>
                        <ul>
                            <li>top</li>
                            <li>search</li>
                            <li>signup</li>
                            <li>signin</li>
                            <li>mypage</li>
                        </ul>                </div>
                    <div class="col-4 text-muted">
                        <h5 class="text-muted">contact info</h5>
                        <ul>
                            <li>☎</li>
                            <li>〒</li>
                            <li>✉</li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    </body>

</html>
