@extends('layouts/main')
@section('user')

<div class="container">

    <div class="top">
        <img src="http://placehold.jp/200x200.png" class="rounded-circle">
        {{-- ユーザー名 --}}
        <h1>{{ UserClass::getUser(request()->id)->name }}</h1>
        {{-- フォローボタン表示 --}}
        @if(Auth::user() and Auth::user()->id != request()->id)
            @if(UserClass::getFollower(request()->id)['follow_flg'] == 1)
                <input type="button" onclick="location.href='/user/{{ request()->id }}/unfollow'" value="フォロー解除">
            @else
                <input type="button" onclick="location.href='/user/{{ request()->id }}/follow'" value="フォロー">
            @endif
        @endif
        {{-- フォロワー数 --}}
        <p>フォロワー: {{ UserClass::getFollower(request()->id)['follower'] }}</p>
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