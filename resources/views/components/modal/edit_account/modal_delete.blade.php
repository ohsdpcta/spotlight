@include('components/user_change', ['modal_name' => 'modal_delete', 'change_name' => 'アカウント削除', 'btn_color' => 'danger', 'user_modal_content' => '
    <br><h3>アカウント削除</h3>
    <hr>
    <p>アカウント削除を行うと同じアカウントを使うことができなくなります。<br><br>本当によろしいですか？</p>
    <label><input type="submit" class="btn btn-danger" name="send" value="アカウント削除"> </label>
    '
])
{{-- <label><input type="submit" class="btn btn-danger" name="send" value="アカウント削除"> </label> --}}
{{-- <button type="button" class="btn btn-danger" onclick="location.href=`/user/{{Auth::id()}}/summary/account/delete`">アカウント削除</button> --}}

