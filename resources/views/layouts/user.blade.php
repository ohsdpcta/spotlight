@extends('layouts/main')
@section('user')

<?php
    $user = UserClass::getUser(request()->id);
    $follow = UserClass::getFollower(request()->id);
    $sprofile = UserClass::getSmallProfile(request()->id);
    $locate = UserClass::getLocate(request()->id);
    $tags = UserClass::getTag(request()->id);
?>

<div class="container">

    <div class="top">
        <div class="row">

            <!-- トップ画像 -->
            <div class="border-bottom col-xl-3 col-lg-3 col-md-4 col-sm-12 pt-2 pb-2">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" width="200" height="200" class="rounded-circle">
                @else
                    <img src="http://placehold.jp/200x200.png" class="rounded-circle">
                @endif
            </div>

            {{-- ユーザー名 --}}
            <div class="border-bottom col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12 pt-2 pr-2 pb-2 pl-2 text-dark">
                @if($user->role == 'Performer')
                    <span class="badge badge-primary">{{ $user->role }}</span>
                @elseif($user->role == 'Spotter')
                    <span class="badge badge-secondary">{{ $user->role }}</span>
                @endif
                <h1>{{ $user->name }}</h1>
                <p>{{'@'}}{{ $user->social_id }}</p>

                {{-- 居場所タグ --}}
                @if($locate)
                    <a class="badge badge-pill badge-success">#{{ $locate->prefecture }}</a>
                    <a class="badge badge-pill badge-success">#{{ $locate->city }}</a>
                @endif

                {{-- タグ --}}
                @foreach($tags as $index => $tag)
                    <form class="" method="get" action="/user/tag_search">
                        <input class="form-control mr-sm-1" type="hidden" name="tag_id" value="{{ $tag->id }}">
                        <button class="tag_btn rounded-pill border-primary px-3 mt-3" type="submit">#{{ $tag->tag_name }}</button>
                    </form>
                @endforeach

                {{-- ショートプロフィール --}}
                <div>
                    @if( !empty($sprofile->scomment) )
                        <div class="pt-4">
                            <h6>{{ $sprofile->scomment }}</h6>
                        </div>
                    @endif
                </div>
            </div>

            <div class="border-bottom col-xl-3 col-lg-3 col-md-12 col-sm-12">
                {{-- フォローボタン --}}
                @if(Auth::user() and Auth::user()->id != request()->id)
                    <div class="col-3">
                        @if($follow['follow_flg'] == 1)
                            <input type="button" onclick="location.href='/user/{{ request()->id }}/unfollow'" class="btn btn-primary" value="フォロー解除">
                        @else
                            <input type="button" onclick="location.href='/user/{{ request()->id }}/follow'" class="btn btn-primary" value=" フォロー ">
                        @endif
                    </div>
                {{-- ユーザーページ編集 --}}
                @elseif(Auth::user() != '')
                    <div class="col-3 pt-2 pb-2">
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
                    <div class="col-3 pb-2">
                        <a href="/user/{{request()->id}}/tip"><img src="https://iconlab.kentakomiya.com/wp/wp-content/uploads/2019/06/icon0084.png" alt="投げ銭" width="30" height="30"></a>
                    </div>
                @endif

            {{-- @endif後で表示 --}}
            </div>
        </div>

        <!-- フォロー、フォロワー -->
        <div class="row">
            <a class="border-bottom col-xl-2 col-lg-2 col-md-2 col-sm-3 col-xs-2" href="/user/{{ request()->id }}/followerlist">{{ $follow['follower'] }} Follower </a>
            <a class="border-bottom col-xl-2 col-lg-2 col-md-2 col-sm-3 col-xs-2" href="/user/{{ request()->id }}/followlist">{{ $follow['follow_count'] }} Follow </a>
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
