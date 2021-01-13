@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

@section('R_form')

<html>
<head>
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key="></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js"></script>
    <meta charset="utf-8">
    <title>PayPayURL編集 / Spotlight</title>
    <style>
        label {color:#ffffff;}
        #map {
        width: 100%;
        height: 400px;
        background-color: grey;
        }
    </style>
</head>
<body>
    <h3 class="text-dark">PayPayURL編集</h3>
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
        <form action="/user/{{Auth::id()}}/summary/paypay" method="post">
            <table>
                @csrf
                {{-- 各種フォーム入力欄 --}}
                {{-- バリデーションエラーがあった場合は、old関数で入力データを復元する --}}
                <label>PayPayURL</label><br>
                <input type="text" name="url" value="{{old('url')}}" maxlength="70" placeholder="PayPayのURLを入力してください。" class="form-control"><br>
                {{-- 各種ボタン --}}
                <input type="submit" value="登録" class="float-right"><br>
            </table>
        </form>
    </div>
<body>
    @if($url)
        <a href="{{ $url }}">{{$url}}</a>
        <form action="/user/{{Auth::id()}}/summary/paypay/delete" method="post">
            @csrf
            {{-- 削除ボタン --}}
            <table>
                <input type="submit" value="削除" class="float-right">
            </table>
        </form>
    @else
        <label>URLが未登録です。</label>
    @endif
</body>
</html>

@endsection