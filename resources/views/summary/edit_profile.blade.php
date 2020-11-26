@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>プロフィール編集 / Spotlight</title>

@section('R_form')

    <style>
        label {color:#ffffff;}
    </style>

    <h3 class="text-light">プロフィール編集</h3>
        <div class="pt-3">
            <form action="/user/{{Auth::id()}}/summary/profile" method="post">
                @csrf
                <label>あなたを知らせるためのプロフィールを記入することができます。</label>
                <textarea name="content" cols="80" rows="5" class="form-control">{{ $data->content }}</textarea><br>
                <input type="submit" value="修正" class="float-right">
            </form>
        </div>

@endsection