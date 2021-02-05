@extends('layouts/main')
@section('user')

<?php
    $user = UserClass::getUser(request()->id);
    $follow = UserClass::getFollower(request()->id);
    $sprofile = UserClass::getSmallProfile(request()->id);
    $locate = UserClass::getLocate(request()->id);
    $tags = UserClass::getTag(request()->id);
    $locate_tag = UserClass::getLocateTag(request()->id);
    $hasrecord = UserClass::hasRecord(request()->id);
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
                @if($locate_tag)
                    <form class="" method="get" action="/user/locate_tag_search">
                        <input type="hidden" name="locate_tag_id" value="{{ $locate_tag->id }}">
                        <button class="btn badge badge-pill badge-success" type="submit">#{{ $locate_tag->prefecture_tag_name }}</button>
                        <button class="btn badge badge-pill badge-success" type="submit">#{{ $locate_tag->city_tag_name }}</button>
                    </form>
                @endif
                <br>

                {{-- タグ --}}
                @if($user->role == 'Performer' && $tags)
                    @foreach($tags as $tag)
                        <a class="badge badge-pill badge-primary" href="/user/tag_search?tag_id={{ $tag->id }}">#{{ $tag->tag_name }}</a>
                    @endforeach
                @endif

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
            </div>

        </div>

        <!-- フォロー、フォロワー -->
        <div class="row">
            <a class="border-bottom col-xl-2 col-lg-2 col-md-2 col-sm-3 col-xs-2" href="/user/{{ request()->id }}/followerlist">{{ $follow['follower'] }} Follower </a>
            <a class="border-bottom col-xl-2 col-lg-2 col-md-2 col-sm-3 col-xs-2" href="/user/{{ request()->id }}/followlist">{{ $follow['follow_count'] }} Follow </a>
        </div>

    </div>

    <div class="tab nav-justified">
        @include('layouts.user/tab', ['user' => $user, 'hasrecord' => $hasrecord])

        <div>@yield('content')</div>

    </div>

</div>

@endsection
