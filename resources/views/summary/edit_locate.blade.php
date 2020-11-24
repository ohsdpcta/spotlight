@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

@section('R_form')

<html>
<head>
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key="></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js"></script>
    <meta charset="utf-8">
    <title>ロケーション編集 / Spotlight</title>
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
    <h3 class="text-light">ロケーション編集</h3>
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
        <form action="/user/{{request()->id}}/summary/locate" method="post">
            <table>
                @csrf
                {{-- 各種フォーム入力欄 --}}
                {{-- バリデーションエラーがあった場合は、old関数で入力データを復元する --}}
                <label>活動場所(座標)</label><br>
                <input type="text" name="coordinate" value="{{old('coordinate')}}" maxlength="30" placeholder="登録したい住所の座標を入力してください。" class="form-control"><br>
                {{-- 各種ボタン --}}
                <input type="submit" value="登録" class="float-right"><br>
            </table>
        </form>
    </div>
<body>
    @if($locate_array)
        <div id="map"></div><br>
        <form action="locate/delete" method="post">
            @csrf
            {{-- 削除ボタン --}}
            <table>
                <input type="submit" value="住所を削除" class="float-right">
            </table>
        </form>
    @else
        <label>活動場所(住所)を登録するとマップが表示されます。</label>
    @endif
</body>
    @if($locate_array)
        <script>
            map = new GMaps({
                div: '#map', //地図を表示する要素
                lat: {{$locate_array[0]}}, //緯度
                lng: {{$locate_array[1]}}, //軽度
                zoom: 18,   //倍率（1～21）
            });
            map.addMarker({
                lat: {{$locate_array[0]}},
                lng: {{$locate_array[1]}},
            });
        </script>
    @endif
</html>

@endsection