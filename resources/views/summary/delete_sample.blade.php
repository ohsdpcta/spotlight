@extends('layouts/summary')

{{-- ----------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>サンプル削除 / Spotlight</title>

@section('R_form')

<h3 class="text-light">サンプル情報削除</h3>
<hr>
<form action="/user/{{Auth::id()}}/summary/sample/delete" method="post">
    @csrf
    <div class="form-group text-dark">
        {{-- <label>サンプル画像</label><input type="text" name="name" class="form-control"> --}}
        @foreach($data as $item)
            {{ $item->name }} ( <a href="{{ $item->url }}">{{ $item->url }}</a> )
            <br>
        @endforeach
        <input type="hidden" name="checked_id_str" value="{{ $checked_id_str }}">
        <input type="submit" value="削除" class="btn btn-danger">
    </div>
</form>

@endsection





