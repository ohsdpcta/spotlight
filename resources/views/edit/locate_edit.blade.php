@extends('layouts/edit')

{{-- ------------------------------------------------------------------------------------------------------- --}}

@section('R_form')

    <style>
        label {color:#ffffff;}
    </style>

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

    <h3 class="text-light">ロケーション情報編集</h3>
    <br>
    <form action="locate" method="POST">
        @csrf
        <div class="form-group">
            {{-- バリデーションエラーがあった場合は、old関数で入力データを復元する --}}
            <label>活動場所(GoogleMapURL)</label><input type="text" name="coordinate" value="{{old('coordinate')}}" class="form-control">
            <br>
            <input type="submit" value="登録" class="btn btn-primary">
            <br>
        </div>
    </form>

@endsection
