<div id="dropdown-control">
    <nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom mt-0 mb-0 pt-0 pb-0 sticky-top row">

        <div class="col-3">
            <a class="navbar-brand navbar-brand-center text-secondary float-left" style="font-family: 'Lobster', cursive;" href="/">Spotlight</a>
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
        <div class="col-7 collapse navbar-collapse">
            @if(!request()->is('/') && !request()->is('user/search*') )
                <form class="form-inline mt-1 mb-1 align-right col-12" action="/user/search">
                    @csrf
                    <input class="form-control mr-sm-1 col-lg-10 col-md-9 col-sm-8" type="search" name="search">
                    <button class="btn col-lg-1 col-md-2 col-sm-3" type="sumbit"><i class="fas fa-search"></i></button>
                </form>
            @endif
        </div>
        <div class="col-2">
            <div class="float-right">
                <div class="nav-item dropdown" v-on:click.stop="dropdown_show = !dropdown_show">
                    <?php $user = Auth::user() ?>
                    @if($user && $user->avatar)
                        <a class="nav-link dropdown-toggle" role="button"><img src="{{ $user->avatar }}" width="35" height="35" class="rounded-circle"></a>
                    @elseif($user)
                        <a class="nav-link dropdown-toggle" role="button"><img src="http://placehold.jp/35x35.png" class="rounded-circle"></a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    {{-- ドロップダウン | テンプレートはhead.blade --}}
    <transition name="dropdown-fade">
        <dropdown-menu v-if="dropdown_show" v-on:close="dropdown_show = false">
        </dropdown-menu>
    </transition>
</div>

<script>
    const dropdown = new Vue({
        el: '#dropdown-control',
        data: {
            dropdown_show: false,
        }
    });
</script>