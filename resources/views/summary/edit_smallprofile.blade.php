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
            <div id="sprofile">
                <input class="form-control" type="text" v-model.trim="message" name="scomment" value="{{ $data ? $data->scomment : '' }}" maxlength="50" placeholder="ひと言コメントを入力してください。">
                <div class="mt-2 float-right">
                    @if($data)
                        <a class="p-0 mb-0 text-muted">@{{ message.length }}/50</a>
                        <input class="btn btn-success ml-1" type="submit" value="修正">
                        <button class="btn btn-danger ml-1" type="button" onclick="location.href='/user/{{Auth::id()}}/summary/smallprofile/delete'">削除</button>
                    @else
                        <a class="p-0 mb-0 text-muted">@{{ message.length }}/50</a>
                        <input class="btn btn-success ml-1" type="submit" value="登録">
                    @endif
                </div>
            </div>
            <script>
                new Vue({
                    el: "#sprofile",
                    data: { message: "" }
                });
            </script>
        </form>
    </div>
</html>

@endsection


