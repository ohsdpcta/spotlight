@extends('layouts/edit')

{{-- -------------------------------------------------------------------------- --}}

@section('R_form')

    <style>
        label {color:#ffffff;}
    </style>

    <h3 class="text-light">グッズ情報編集</h3>
    <br>
    <p class="text-light">グッズ追加</p>
    <hr>
    <form action="add" method="post">
        @csrf
        <div class="form-group">
            <label>グッズ名</label><input type="text" name="name" class="form-control">
            <br>
            <label>URL</label><input type="text" name="url" class="form-control">
            <br>
            <input type="submit" value="登録" class="btn btn-primary">
        </div>
    </form>
{{-- --------------------------------------以下未編集------------------------------------- --}}
    @foreach($data as $item)
        <p><input type="checkbox" name="check" value="{{$item->id}}">
        <a href="{{ $item->url }}">{{ $item->name }}</a>
        <a href="/user/{{request()->id}}/edit/goods/{{$item->id}}/del">削除</p>
    @endforeach
        {{--{{request()->id()}}でURLのユーザーID取得  --}}
        <p><a href="/user/{{request()->id}}/goods/multi_del">選択削除</p>
{{-- --------------------------------------以上未編集------------------------------------------ --}}
@endsection

