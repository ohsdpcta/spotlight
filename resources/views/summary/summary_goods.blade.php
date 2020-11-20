@extends('layouts/edit')

{{-- ----------------------------------------------------------------- --}}

@section('R_form')

<div class="container">

    {{-- 新規追加ボタン --}}
    <button type="button" class="btn btn-secondary btn-block" onclick="location.href='/user/{{$item->id}}/summary/goods/add'">新規追加</button>

    @foreach($result as $item)
        {{-- 背景の四角 --}}
        <div class="row bg-dark mt-1 pt-1 pb-1 pl-1 maru">
            {{-- サムネ --}}
            <div class="">
                <img src="http://placehold.jp/50x50.png" class="rounded-circle">
            </div>
            {{-- リンク --}}
            <div class="col-lg-11 col-md-11 col-sm-10 col-xs-7 align-items-center d-flex">
                <p>{{ $item->name }}</p>
                <button type="button" class="btn btn-secondary btn-block" onclick="location.href='/user/{{$item->id}}/summary/goods/edit'">編集</button>
                <button type="button" class="btn btn-secondary btn-block" onclick="location.href='/user/{{$item->id}}/summary/goods/delete'">削除</button>
            </div>
        </div>
    @endforeach
</div>

@endsection





