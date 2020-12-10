@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>プロフィール編集 / Spotlight</title>

@section('R_form')
    <head>
        <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.min.css" />
        <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
        <style>
            label {color:#ffffff;}
        </style>
    </head>

    <h3 class="text-light">プロフィール編集</h3>
    <div class="pt-3">
        <form action="/user/{{Auth::id()}}/summary/profile" method="post">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <label>あなたを知らせるためのプロフィールを記入することができます。</label>
            <textarea id="content" name="content" cols="80" rows="5" class="form-control">{{ $data->content }}</textarea><br>
            <input type="submit" value="修正" class="float-right"><br>
        </form>
    </div>
    <div id="editor" style="background-color:#fff;"></div>

    <script>
        const Editor = toastui.Editor;
        const editor = new Editor({
            el: document.querySelector('#editor'),
            height: '500px',
            initialEditType: 'markdown',
            previewStyle: 'vertical'
        });
        editor.getHtml();
    </script>

@endsection