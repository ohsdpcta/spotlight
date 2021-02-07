
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link @if(request()->is('*profile')) active @endif" href="/user/{{request()->id}}/profile">プロフィール</a>
    </li>
    @if($user->role == 'Performer')
        @if($hasrecord['locate'])
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*locate')) active @endif" href="/user/{{request()->id}}/locate">ロケーション</a>
            </li>
        @endif
        @if($hasrecord['goods'])
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*goods')) active @endif" href="/user/{{request()->id}}/goods">グッズ</a>
            </li>
        @endif
        @if($hasrecord['sample'])
            <li class="nav-item">
                <a class="nav-link @if(request()->is('*sample')) active @endif" href="/user/{{request()->id}}/sample">サンプル</a>
            </li>
        @endif
        @if(!$hasrecord['locate'])
            <li class="nav-item">
            </li>
        @endif
        @if(!$hasrecord['goods'])
            <li class="nav-item">
            </li>
        @endif
        @if(!$hasrecord['sample'])
            <li class="nav-item">
            </li>
        @endif
    @elseif($user->role == 'Spotter')
        <li class="nav-item">
            <a class="nav-link disabled" href="#"></a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#"></a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#"></a>
        </li>
    @endif
</ul>