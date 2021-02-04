@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

@section('R_form')

<html>
<head>
    <meta charset="utf-8">
    <title>ひと言コメント編集 / Spotlight</title>
    <style>
        #map {
        width: 100%;
        height: 400px;
        background-color: grey;
        }
    </style>
</head>
    <h3 class="text-dark">ひと言コメント編集</h3>
    <div class="pt-3">
        {{-- バリデーションエラーがある場合は出力 --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/user/{{Auth::id()}}/summary/smallprofile" method="post">
            @csrf
            {{-- 各種フォーム入力欄 --}}
            {{-- バリデーションエラーがあった場合は、old関数で入力データを復元する --}}
            <label>ひと言コメント</label><br>
            <input type="text" name="scomment" value="{{$data->scomment}}" maxlength="50" placeholder="ひと言コメントを入力してください。" class="form-control col-12 mb-2" >
            {{-- 各種ボタン --}}
            <div class="float-right">
                @if($data)
                    <input type="submit" value="修正" class="btn btn-success">
                    <button type="button" class="btn btn-danger" onclick="location.href='/user/{{Auth::id()}}/summary/smallprofile/delete'">削除</button>
                @else
                    <input type="submit" value="登録" class="btn btn-primary">
                @endif
            </div>
            @if($data)

            @else
                <label>ひと言コメントが未登録です。</label>
            @endif
        </form>
    </div>
</html>

@endsection
