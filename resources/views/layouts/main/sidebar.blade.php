<div class="side-content">
    <button type="button" class="btn btn-info btn_menu sidebar-btn">
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
                    <button class="btn btn-outline-primary btn-block pl-2" onclick="location.href='/user/signin'">
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
