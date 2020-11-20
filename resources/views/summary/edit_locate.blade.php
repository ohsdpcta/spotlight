@extends('layouts/edit')

{{-- ------------------------------------------------------------------------- --}}

@section('R_form')

    <style>
        label {color:#ffffff;}
    </style>


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
                    <tr><th><label><font size="" color="white">活動場所(住所)</font></label></th><td>
                    <input type="text" name="coordinate" value="{{old('coordinate')}}" class="form-control"></td></tr>
                    {{-- 各種ボタン --}}
                    <tr><th></th><td><input type="submit" value="登録"></td></tr>
                </table>
            </form>

        </div>

@endsection