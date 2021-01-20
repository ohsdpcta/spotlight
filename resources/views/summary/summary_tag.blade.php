@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>タグ編集 / Spotlight</title>

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
        <h3 class="text-dark col-md-4">タグ編集</h3>
    </div>

    <div class="row">
        {{-- 新規追加ボタン --}}
        <button type="button" class="btn btn-secondary btn-block col-md-2 offset-md-10 mb-1" onclick="location.href='/user/{{Auth::id()}}/summary/tag/add'"><i class="fas fa-plus"></i></button>
    </div>

    <hr>

    {{-- フラッシュメッセージ --}}
    @if(session('flash_message_error'))
        <div class="alert alert-danger text-center py-3 my-0">
            {{ session('flash_message_error') }}
        </div>
    @endif

    <form method="get" action="/user/{{Auth::id()}}/summary/tag/delete">
        @csrf
        <input class="btn btn-danger" type="submit" value="削除">

        {{-- タグ一覧を出力 --}}
        <?php $tags = UserClass::getTag(request()->id) ?>
        @foreach($tags as $index => $tag)
        <div class="row maru pt-1 pb-1 mb-1 mt-1" style="background-color: rgb(240, 240, 240)">
            #{{ $tag->tag_name }}
            {{-- 選択削除チェックボックス --}}
            <input type="checkbox" class="col-lg-1 col-md-1 col-sm-1 col-xs-1 d-flex align-items-center form-control mt-1" name="checked_items[]" value="{{$item->id}}">
        </div>
        @endforeach

    </form>
    {{-- {{ $data->links('vendor.pagination.sample-pagination') }} --}}

</div>

@endsection





