@extends('layouts/main')
@section('user')

<div class="container">

    <div class="top">
        <img src="http://placehold.jp/200x200.png" class="rounded-circle">
        <h1>{{ UserClass::getUser(request()->id)->name }}</h1>
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
                <a href="spotlight/user/:id/locate" class="nav-link">ロケーション</a>
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
