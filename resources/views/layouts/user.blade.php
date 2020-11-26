@extends('layouts/main')
@section('user')

<div class="container">

    <div class="top">
        <div class="row">
            <div class="col-md-3 col-sm-3 pt-2 pl-2 pb-2">
                <img src="http://placehold.jp/200x200.png" class="rounded-circle">
            </div>
            {{-- ユーザー名 --}}
            <div class="col-md-6 col-sm-6 pt-2 pr-2 pb-2 pl-2">
                <h1>{{ UserClass::getUser(request()->id)->name }}</h1>
                {{-- タグ(仮) --}}
                <div class="pt-4">
                    <h5>タグ挿入予定地(仮)</h5>
                </div>
            </div>
            {{-- フォローボタン表示 --}}
            <div class="col-md-2 col-sm-2 pt-3 pl-1">
            {{-- @if(Auth::user() and Auth::user()->id != request()->id)あとで表示 --}}
                @if(UserClass::getFollower(request()->id)['follow_flg'] == 1)
                    <input type="button" onclick="location.href='/user/{{ request()->id }}/unfollow'" class="btn btn-primary" value="フォロー解除">
                @else
                    <input type="button" onclick="location.href='/user/{{ request()->id }}/follow'" class="btn btn-primary" value=" フォロー ">
                @endif
            {{-- ユーザーページ編集 --}}
                <div class="pt-1">
                    <input class="btn btn-success" value="ユーザーページ編集" type="button"
                        onclick="location.href='/user/{{request()->id}}/summary/@if(request()->is('*profile'))profile\
                        @elseif(request()->is('*locate'))locate\
                        @elseif(request()->is('*goods'))goods\
                        @elseif(request()->is('*sample'))sample\
                        @endif'"
                    >
                </div>
                {{-- 投げ銭ボタン --}}
                @if( !empty(UserClass::get_paypay_url(request()->id)) )
                    <div class="pt-2">
                        <a href="/user/{{request()->id}}/tip"><img src="https://iconlab.kentakomiya.com/wp/wp-content/uploads/2019/06/icon0084.png" alt="投げ銭" width="30" height="30"></a>
                    </div>
                @endif
            {{-- @endif後で表示 --}}
            </div>
        </div>
        <div class="row">
            {{-- フォロワー数 --}}
            <div class="col-md-6 mt-2">
                <p>フォロー中: {{ UserClass::getFollower(request()->id)['follow_count'] }}　　　
                フォロワー: {{ UserClass::getFollower(request()->id)['follower'] }}</p>
            </div>
        </div>
    </div>

    <div class="tab w-100 nav-justified">
        <ul class="nav nav-tabs">

            {{-- @if ($tekitou == 'profile') --}}
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*profile')) active @endif" href="/user/{{request()->id}}/profile">プロフィール</a>
            </li>
            {{-- @else
            <li class="nav-item">
                <a href="spotlight/user/:id/profile" class="nav-link ">プロフィール</a>
            </li>
            @endif --}}

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
