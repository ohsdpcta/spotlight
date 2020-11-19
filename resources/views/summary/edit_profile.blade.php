@extends('layouts/edit')

{{-- ------------------------------------------------------------------------- --}}

@section('R_form')

    <style>
        label {color:#ffffff;}
    </style>


    <h3 class="text-light">プロフィール編集</h3>
        <div class="pt-3">
            <form action="/user/{{request()->id}}/summary/profile" method="post">
                @csrf
                <label>あなたを知らせるためのプロフィールを記入することができます。</label>
                <textarea name="content" cols="80" rows="5" class="form-control">{{ $data->content }}</textarea>
                <input type="submit" value="修正" class="float-right">
            </form>
        </div>

@endsection