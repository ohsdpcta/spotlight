@extends('layouts/main')
@section('user')

<div class="container">

    <div class="top">
        <div class="row">
            <div class="col-md-3 pt-2 pl-4">
                <img src="http://placehold.jp/200x200.png" class="rounded-circle">
            </div>
            {{-- ユーザー名 --}}
            <div class="col-4 pt-2 pr-2 pb-2 pl-1">
                <h1>{{ UserClass::getUser(request()->id)->name }}</h1>
                {{-- タグ(仮) --}}
                <div class="pt-4">
                    <h5>タグ挿入予定地(仮)</h5>
                </div>
            </div>
            {{-- フォローボタン表示 --}}
            <div class="col-4 pt-3 pl-1">
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
            {{-- @endif後で表示 --}}
            </div>
        </div>
        <div class="row">
            <div class="col-1 col-md-3"></div>
            {{-- フォロワー数 --}}
            <div class="col-1 col-md-6 pl-1">
                <p>フォロー中: {{ UserClass::getFollower(request()->id)['follower'] }}　　　
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
