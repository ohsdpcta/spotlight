@extends('layouts/main')
@section('user')

<!-- CSSはmainのものも参照するため注意 -->
{{-- -------------------------------------------------------------- --}}

<div class="container">

    <div class="top">
        <div class="row">

            <!-- トップ画像 -->
            <div class="border col-xl-3 col-lg-3 col-md-4 col-sm-12 pt-2 pb-2">
                <img src="http://placehold.jp/200x200.png" class="rounded-circle">
            </div>

            {{-- ユーザー名 --}}
            <div class="border col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12 pt-2 pr-2 pb-2 pl-2">
                <h1>{{ UserClass::getUser(request()->id)->name }}</h1>
                {{-- タグ(仮) --}}
                <div class="pt-4">
                    <h5>タグ挿入予定地(仮)</h5>
                </div>
            </div>

            {{-- フォローボタン, 編集ページリンク等…… --}}
            <div class="border col-xl-2 col-lg-2 col-md-12 col-sm-12">
                <!-- フォローボタン -->
                @if(Auth::user() and Auth::user()->id != request()->id)
                    <div class="col-3">
                        @if(UserClass::getFollower(request()->id)['follow_flg'] == 1)
                            <input type="button" onclick="location.href='/user/{{ request()->id }}/unfollow'" class="btn btn-primary" value="フォロー解除">
                        @else
                            <input type="button" onclick="location.href='/user/{{ request()->id }}/follow'" class="btn btn-primary" value=" フォロー ">
                        @endif
                    </div>
                {{-- ユーザーページ編集 --}}
                @elseif(Auth::user() != '')
                    <div class="col-3 pt-2">
                        <input class="btn btn-success" value="ユーザーページ編集" type="button"
                            onclick="location.href='/user/{{Auth::id()}}/summary/@if(request()->is('*profile'))profile\
                            @elseif(request()->is('*locate'))locate\
                            @elseif(request()->is('*goods'))goods\
                            @elseif(request()->is('*sample'))sample\
                            @endif'"
                        >
                    </div>
                @endif

                {{-- 投げ銭ボタン --}}
                @if( !empty(UserClass::get_paypay_url(request()->id)) )
                    <div class="col-3 pt-2 pb-2">
                        <a href="/user/{{request()->id}}/tip"><img src="https://iconlab.kentakomiya.com/wp/wp-content/uploads/2019/06/icon0084.png" alt="投げ銭" width="30" height="30"></a>
                    </div>
                @endif

            {{-- @endif後で表示 --}}
            </div>
        </div>

        <!-- フォロー、フォロワー -->
        <div class="row">
            <a class="border col-xl-2 col-lg-2 col-md-2 col-sm-3 col-xs-2" href="/user/{{ request()->id }}/followerlist">{{ UserClass::getFollower(request()->id)['follower'] }} Follower </a>
            <a class="border col-xl-2 col-lg-2 col-md-2 col-sm-3 col-xs-2" href="/user/{{ request()->id }}/followlist">{{ UserClass::getFollower(request()->id)['follow_count'] }} Follow </a>
        </div>

    </div>

    <div class="tab nav-justified">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*profile')) active @endif" href="/user/{{request()->id}}/profile">プロフィール</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*locate')) active @endif" href="/user/{{request()->id}}/locate">ロケーション</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*goods')) active @endif" href="/user/{{request()->id}}/goods">グッズ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*sample')) active @endif" href="/user/{{request()->id}}/sample">サンプルリンク</a>
        </ul>

        <div>@yield('content')</div>

    </div>

</div>

@endsection
