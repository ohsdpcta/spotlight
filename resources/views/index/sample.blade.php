@extends('layouts.user')

@section('content')
<html>
<head>
    <meta charset="utf-8">
    <title>サンプル / Spotlight</title>
</head>
<body>
    @if(count($data)==0)
        リンクが登録されていません
    @else
        <ul class="list-group">
            @foreach ($data as $item)
                <li class="list-group-item">
                {{-- <a href="{{ $item->url }}">{{ $item->name }}</a> --}}
                @if($item->embed_site=="youtube")
                    <iframe width="560" height="315" src="{{ $item->url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @elseif($item->embed_site=="youtube_list")
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list={{ $item->url }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                @elseif($item->embed_site=="soundcloud")
                    <iframe width="100%" height="300" scrolling="no" frameborder="no" allow="autoplay" src="{{ $item->url[1][0] }}"></iframe>
                    <div style="font-size: 10px; color: #cccccc;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;">
                    <a href="{{ $item->url[2][1] }}" title="{{ $item->url[3][2] }}" target="_blank" style="color: #cccccc; text-decoration: none;">{{ $item->url[3][2] }}</a>
                    · <a href="{{ $item->url[2][3] }}" title="{{ $item->url[3][4] }}" target="_blank" style="color: #cccccc; text-decoration: none;">{{ $item->url[3][4] }}</a>
                    </div>
                @endif
                </li>
            @endforeach
        </ul>
        {{ $data->links('vendor.pagination.sample-pagination') }}
    @endif
</body>
</html>
@endsection