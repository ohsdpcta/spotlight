@extends('layouts/main')
@section('user')

<div class="container">

    <div class="top">
        <img src="http://placehold.jp/200x200.png" class="rounded-circle">
        {{-- <h1>{{ UserClass::getUser(request()->id)->name }}</h1> --}}
        @if(Auth::user() and Auth::user()->id != request()->id)
            @if(UserClass::getFollower(request()->id)['follow_flg'] == 1)
                <input type="button" onclick="location.href='/user/{{ request()->id }}/unfollow'" value="フォロー解除">
            @else
                <input type="button" onclick="location.href='/user/{{ request()->id }}/follow'" value="フォロー">
            @endif
        @endif
        <p>フォロワー: {{ UserClass::getFollower(request()->id)['follower'] }}</p>
    </div>

    <div class="tab w-100 nav-justified">
        <ul class="nav nav-tabs">

            {{-- @if ($tekitou == 'profile') --}}
            <li class="nav-item">
                <a href="spotlight/user/:id/profile" class="nav-link active">プロフィール</a>
            </li>
            {{-- @else
            <li class="nav-item">
                <a href="spotlight/user/:id/profile" class="nav-link ">プロフィール</a>
            </li>
            @endif --}}

            <li class="nav-item">
                <a href="/user/{{request()->id}}/locate/add_address" class="nav-link">ロケーション</a>
            </li>
            <li class="nav-item">
                <a href="spotlight/user/:id/goods" class="nav-link">グッズ</a>
            </li>
            <li class="nav-item">
                <a href="spotlight/user/:id/sample" class="nav-link">サンプルリンク</a>
            </li>
        </ul>

        <div>@yield('content')</div>

    </div>

</div>

@endsection
