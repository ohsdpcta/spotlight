@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>グッズ編集 / Spotlight</title>

@section('R_form')

<style>
    .maru {
        /* 左上　右上　右下　左下 */
        border-radius: 50px 10px 10px 50px;
    }
    /* .fontsize {
        font-size: 150%;
    } */
</style>

<div class="container">

    <div class="row">
        <h3 class="text-dark col-md-4">グッズ編集</h3>
    </div>

    <div class="row">
        {{-- 新規追加ボタン --}}
        <button type="button" class="btn btn-secondary btn-block col-md-2 offset-md-10 mb-1" onclick="location.href='/user/{{Auth::id()}}/summary/goods/add'"><i class="fas fa-plus"></i></button>
    </div>

    <hr>

    @if(session('flash_message_error'))
        <div class="alert alert-danger text-center py-3 my-0">
            {{ session('flash_message_error') }}
        </div>
    @endif
    <form method="get" action="/user/{{Auth::id()}}/summary/goods/delete">
        @csrf
        <input class="btn btn-danger" type="submit" value="削除">

        @foreach($data as $item)

            {{-- <div class="row"> --}}
                {{-- 背景の四角 --}}
                <div class="row maru pt-1 pb-1 mb-1 mt-1" style="background-color: rgb(240, 240, 240)">

                    {{-- サムネ --}}
                    <div class="col-md-1">
                        <img src="http://placehold.jp/50x50.png" class="rounded-circle">
                    </div>

                    {{-- グッズ編集へのリンク --}}
                    <h3 class="col-md-8 fontsize d-flex align-items-center">{{ $item->name }}</h3>
                    <button class="col-md-2 btn btn-light btn-block" type="button" onclick="location.href='/user/{{$item->user_id}}/summary/goods/{{$item->id}}/edit'">編集</button>

                    {{-- 選択削除チェックボックス --}}
                    <input type="checkbox" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 d-flex align-items-center form-control mt-1" name="checked_items[]" value="{{$item->id}}">

                </div>
            {{-- </div> --}}

        @endforeach
    </form>
    {{ $data->links('vendor.pagination.sample-pagination') }}

</div>

@endsection





