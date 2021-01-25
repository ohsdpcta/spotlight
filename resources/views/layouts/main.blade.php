<html>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="/common/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="/common/js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>

        <!-- cssは移設しました -->
        <link rel="stylesheet" href="{{ asset('styles/main.css') }}">
        <link rel="stylesheet" href="{{ asset('styles/sidebar.css') }}">
    </head>

    <header></header>

    <body>
        {{-- ヘッダー --}}
        <div>
        <nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom mt-0 mb-0 pt-0 pb-0 sticky-top row">

            <div class="col-4">
                <a class="navbar-brand navbar-brand-center text-dark float-left" href="/">Spotlight</a>
                <div class="collapse navbar-collapse float-left">
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
            </div>

            {{-- indexのnavbarでは検索フォームを非表示 --}}
            <div class="col-6 collapse navbar-collapse">
                @if(!(request()->path() == '/'))
                    <form class="form-inline mt-1 mb-1 align-right col-12" action="/user/search">
                        @csrf
                        <input class="form-control mr-sm-1 col-lg-9 col-md-8 col-sm-7" type="search" name="search">
                        <button class="btn btn-primary col-lg-2 col-md-3 col-sm-4" type="submit">検索</button>
                    </form>
                @endif
            </div>
            <div class="col-2">
                <div id="user-icon" class="float-right">
                    <?php $user = UserClass::getUser(Auth::id()) ?>
                    @if($user && $user->avatar)
                        <img src="{{ $user->avatar }}" width="35" height="35" class="rounded-circle">
                    @else
                        <img src="http://placehold.jp/200x200.png" style="width: 35; height: 35" class="rounded-circle">
                    @endif
                </div>
            </div>
        </nav>

        @if(session('flash_message'))
            <transition name="fade" id="flash-message">
                <div v-if="show" class="alert alert-primary text-center py-3 my-0">
                    {{ session('flash_message') }}
                </div>
            </transition>
        @elseif(session('flash_message_error'))
            <transition name="fade" id="flash-message">
                <div v-if="show" class="alert alert-danger text-center py-3 my-0">
                    {{ session('flash_message_error') }}
                </div>
            </transition>
        @endif

        <style>
            .fade-enter-active, .fade-leave-active {
                transition: all 1s;
            }
            .fade-enter, .fade-leave-to {
                opacity: 0;
                transform: translateY(-50px);
            }
        </style>
        <script>
            new Vue({
                el: '#flash-message',
                data: {
                    show: false,
                },
                created: function(){
                    setTimeout(()=>{
                        this.show = !this.show;
                    }, 100);
                    setTimeout(()=>{
                        this.show = !this.show;
                    }, 3000);
                }
            })
        </script>

        <div class="side-content">
            <button type="button" class="btn btn-info btn_menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
            <!-- サイド(ドロワー)メニュー https://296.co.jp/article/09392320181809143 -->
            <nav class="border container sidebar text-dark">
                <br>
                {{-- 非ログイン時 --}}
                @if(!Auth::user())
                <ul>
                    <li class="mt-2">
                        <button class="btn btn-outline-primary btn-block pl-2" onclick="location.href='/user/signup'">
                            <i class="fas fa-user-plus" style="font-size: 1.7em"></i>
                            <strong class="ml-2">sign up</strong>
                        </button>
                    </li>
                    <li class="mt-2">
                        <button class="btn btn-outline-primary btn-block pl-2" onclick="location.href='/user/signup'">
                            <i class="fas fa-sign-in-alt fa-2x" style="font-size: 2.1em"></i>
                            <strong class="ml-2">sign in</strong>
                        </button>
                    </li>
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
                                            <?php $follower = UserClass::getUser($item->target_id) ?>
                                            @if($follower->avatar)
                                                <img src="{{ $follower->avatar }}" width="200" height="200" class="rounded-circle">
                                            @else
                                                <img src="http://placehold.jp/30x30.png" class="rounded-circle">
                                            @endif
                                            {{ $follower->name }}
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </ul>
                @endif
            </nav>
        </div>

        <script>
            $(function(){
                $('.btn_menu').click(function(){$('nav.sidebar').toggleClass('open');});
                $('.btn_menu').click(function(){$('button.btn_menu').toggleClass('open');});

                $(document).click(function(e) {
                    // クリックした場所がmenu-wrapper(領域内とみなす範囲)に無ければmenuを消す
                    if(!$.contains($('div.side-content')[0], e.target)){
                        if($('nav.sidebar').hasClass('open')){
                            $('nav.sidebar').removeClass('open');
                        }
                        if($('button.btn_menu').hasClass('open')){
                            $('button.btn_menu').removeClass('open');
                        }
                    }
                });
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
