<div class="top">
    <div class="row">

        <!-- トップ画像 -->
        <div class="col-3 col-sm-3 col-md-3 py-2 pl-4 align-self-center">
            @if($user->avatar)
                @if(session('device') == "mobile")
                    <img src="{{ $user->avatar }}" width="40" height="40" class="rounded-circle">
                @else
                    <img src="{{ $user->avatar }}" width="200" height="200" class="rounded-circle">
                @endif
            @else
                @if(session('device') == "mobile")
                    <img src="https://placehold.jp/60x60.png" class="rounded-circle">
                @else
                    <img src="http://placehold.jp/200x200.png" class="rounded-circle">
                @endif
            @endif
        </div>

        <div class="col-9 col-sm-9 col-md-9 @if(session('device')=='mobile')align-self-center\@endif">
            {{-- フォローボタン --}}
            @if(Auth::user() and Auth::user()->id != request()->id)
                <div class="float-right">
                    @if($follow['follow_flg'] == 1)
                        <input type="button" onclick="location.href='/user/{{ request()->id }}/unfollow'" class="btn btn-primary" value="フォロー解除">
                    @else
                        <input type="button" onclick="location.href='/user/{{ request()->id }}/follow'" class="btn btn-primary" value=" フォロー ">
                    @endif
                </div>
            {{-- ユーザーページ編集 --}}
            @elseif(Auth::user() != '')
                <div class="float-right">
                    <input class="btn btn-sm btn-success" value="ユーザーページ編集" type="button"
                        onclick="location.href='/user/{{Auth::id()}}/summary/@if(request()->is('*profile'))profile\
                        @elseif(request()->is('*locate'))locate\
                        @elseif(request()->is('*goods'))goods\
                        @elseif(request()->is('*sample'))sample\
                        @endif'"
                    >
                </div>
            @endif
        </div>

        {{-- ユーザー名 --}}
        <div class="col-12 col-sm-12 col-md-8 pr-2 pb-2 pl-1 text-dark">
            <h4 class="d-inline">{{ $user->name }}</h4>
            @if($user->role == 'Performer')
                <span class="badge badge-primary align-text-top">{{ $user->role }}</span>
            @elseif($user->role == 'Spotter')
                <span class="badge badge-secondary align-text-top">{{ $user->role }}</span>
            @endif
        </div>

        <div class="col-12 col-sm-12 px-0">
            <p>{{'@'}}{{ $user->social_id }}</p>
        </div>

        {{-- 居場所タグ --}}
        @if($user->role == 'Performer' && $prefecture && $city)
            <div>
                <a class="badge badge-pill badge-success" href="/user/search?prefecture={{ $prefecture->name }}">#{{ $prefecture->name }}</a>
                <a class="badge badge-pill badge-success" href="/user/search?city={{ $city->name }}">#{{ $city->name }}</a>
            <br>
            </div>
        @endif

        {{-- タグ --}}
        @if($user->role == 'Performer' && $tags)
            <div>
                @foreach($tags as $tag)
                    <a class="badge badge-pill badge-primary" href="/user/tag_search?tag_id={{ $tag->id }}">#{{ $tag->tag_name }}</a>
                @endforeach
            </div>
        @endif

        {{-- ショートプロフィール --}}
        @if( !empty($sprofile->scomment) )
            <div>
                <div class="pt-4">
                    <h6>{{ $sprofile->scomment }}</h6>
                </div>
            </div>
        @endif

        <!-- フォロー、フォロワー -->
        <div>
            <a class="col-4 col-sm-4 pl-0" href="/user/{{ request()->id }}/followerlist">{{ $follow['follower'] }} Follower </a>
            <a class="col-4 col-sm-4" href="/user/{{ request()->id }}/followlist">{{ $follow['follow_count'] }} Follow </a>
        </div>
    </div>
</div>