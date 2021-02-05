@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>アカウント編集 / Spotlight</title>

@section('R_form')
    {{-- @include('components/all_info') --}}

    <h3 class="text-dark">ユーザー情報編集</h3>
    <br>
    <form action="/user/{{Auth::id()}}/summary/account" method="post" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form-group">
            <label>ユーザー名</label>
            <input type="text" name="name" value="{{ $data->name }}" class="form-control">
            <br>
            <div class="row pl-3">
                <label>ロール</label>
                <div class="pt-1 pl-2">
                    @include('components/modal/edit_account/modal_role')
                </div>
            </div>
            <div class="form-check-inline">
                <label><input class="form-check-input" type="radio" name="role" value="Performer" {{ $data->role == "Performer" ? 'checked="checked"' : ''}}>パフォーマー</label>
            </div>
            <div class="form-check-inline">
                <label><input class="form-check-input" type="radio" name="role" value="Spotter" {{ $data->role == "Spotter" ? 'checked="checked"' : ''}}>スポッター</label>
            </div>
            <br>

            <!-- アップロードフォームの作成 -->
            <div class="row">
                <label class="col-12">プロフィールアイコン</label>
                <!-- トップ画像 -->
                <div class="border-bottom col-xl-3 col-lg-3 col-md-4 col-sm-12 pt-2 pb-2">
                    @if($data->avatar)
                        <img src="{{ $data->avatar }}" width="200" height="200" class="rounded-circle">
                    @else
                        <img src="http://placehold.jp/200x200.png" class="rounded-circle">
                    @endif
                </div>
                <input type="file" name="image" class="col-12">
            </div>

            <div class="mt-2">
                <input type="submit" value="修正" class="btn btn-success">
                <button type="button" class="btn btn-danger" onclick="location.href='/user/{{Auth::id()}}/summary/account/delete'">削除</button>
            </div>
        </div>

        <hr>

        サンプルボーダル@include('components/modal/edit_account/modal_email')
    </form>
@endsection