@extends('layouts/user')

@section('content')

<html>
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
    <form action="add_address" method="POST">
        <table>
            @csrf
            {{-- 各種フォーム入力欄 --}}
            {{-- バリデーションエラーがあった場合は、old関数で入力データを復元する --}}
            <tr><th>活動場所(住所)</th><td><input type="text" name="street_address" value="{{old('street_address')}}"></td></tr>
            {{-- 各種ボタン --}}
            <tr><th></th><td><input type="submit" value="登録"></td></tr>
        </table>
    </form>

</html>
@endsection
