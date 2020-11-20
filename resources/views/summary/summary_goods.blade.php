@extends('layouts/edit')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>グッズ編集 / Spotlight</title>

@section('R_form')

<style>
    .maru {
        /* 左上　右上　右下　左下 */
        border-radius: 50px 10px 10px 50px;
    }
    .black {
        background-color: #2c2c2c;
    }
    /* .fontsize {
        font-size: 150%;
    } */
</style>

<div class="container">

    <div class="row">
        <h3 class="text-light col-md-4">グッズ編集</h3>
    </div>

    <div class="row">
        {{-- 新規追加ボタン --}}
        <button type="button" class="btn btn-secondary btn-block col-md-2 offset-md-10 mb-1" onclick="location.href='/user/{{request()->id}}/summary/goods/add'"><i class="fas fa-plus"></i></button>
    </div>

    <hr>

    @foreach($data as $item)

        {{-- <div class="row"> --}}
            {{-- 背景の四角 --}}
            <div class="row black maru pt-1 pb-1 mb-1 mt-1">

                {{-- サムネ --}}
                <div class="col-md-1">
                    <img src="http://placehold.jp/50x50.png" class="rounded-circle">
                </div>

                {{-- グッズ編集へのリンク --}}
                <h3 class="col-md-8 text-light fontsize d-flex align-items-center border">{{ $item->name }}</h3>
                <button class="col-md-2 btn btn-secondary btn-block" type="button" onclick="location.href='/user/{{$item->id}}/summary/goods/edit'">編集</button>

                {{-- 選択削除チェックボックス --}}
                <form method="post" action="remove" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 d-flex align-items-center">
                    <input type="checkbox" name="goods_delete[]" value="{{$item->id}}">
                </form>

            </div>
        {{-- </div> --}}

    @endforeach
    {{ $data->links('vendor.pagination.sample-pagination') }}

</div>

@endsection





