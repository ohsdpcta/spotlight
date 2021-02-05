
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link @if(request()->is('*profile')) active @endif" href="/user/{{request()->id}}/profile">プロフィール</a>
    </li>
    @if($user->role == 'Performer')
        <li class="nav-item">
            @if($hasrecord['locate'])
                <a class="nav-link @if(request()->is('*locate')) active @endif" href="/user/{{request()->id}}/locate">ロケーション</a>
            @else
                <a class="nav-link disabled" href="/user/{{request()->id}}/locate">ロケーション</a>
            @endif
        </li>
        <li class="nav-item">
            @if($hasrecord['goods'])
                <a class="nav-link @if(request()->is('*goods')) active @endif" href="/user/{{request()->id}}/goods">グッズ</a>
            @else
                <a class="nav-link disabled" href="/user/{{request()->id}}/goods">グッズ</a>
            @endif
        </li>
        <li class="nav-item">
            @if($hasrecord['sample'])
                <a class="nav-link @if(request()->is('*sample')) active @endif" href="/user/{{request()->id}}/sample">サンプルリンク</a>
            @else
                <a class="nav-link disabled" href="/user/{{request()->id}}/sample">サンプルリンク</a>
            @endif
        </li>
    @elseif($user->role == 'Spotter')
        <li class="nav-item">
            <a class="nav-link disabled" href="/user/{{request()->id}}/locate">ロケーション</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="/user/{{request()->id}}/goods">グッズ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="/user/{{request()->id}}/sample">サンプルリンク</a>
        </li>
    @endif
</ul>