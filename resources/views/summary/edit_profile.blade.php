@extends('layouts/summary')

{{-- ------------------------------------------------------------------------- --}}

<meta charset="utf-8">
<title>プロフィール編集 / Spotlight</title>

@section('R_form')
    <head>
        <script src="https://uicdn.toast.com/editor/latest/toastui-editor-all.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.48.4/codemirror.min.css" />
        <link rel="stylesheet" href="https://uicdn.toast.com/editor/latest/toastui-editor.min.css" />
    </head>

    <h3 class="text-dark">プロフィール編集</h3>
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
            <label class="text-dark">あなたを知らせるためのプロフィールを記入することができます。</label>
            <input type="hidden" id="content" name="content" cols="80" rows="5" class="form-control">
            <input type="submit" id="edit" class="btn btn-success float-right" value="修正"><br>
        </form>
    </div>
    <div id="editor" style="background-color:rgb(255, 255, 255);"></div>

    <script>
        const Editor = toastui.Editor;
        const editor = new Editor({
            el: document.querySelector('#editor'),
            height: '500px',
            initialEditType: 'markdown',
            previewStyle: 'vertical'
        });
        const old_content = @json($data->content);
        editor.insertText(old_content);
        editor.getHtml();

        document.getElementById('edit').onclick = function() {
            let content = editor.getMarkdown();
            document.getElementById('content').value = content;
            document.getElementById('content').style.display ="none";
        };
    </script>

@endsection