@include('components/user_change', ['modal_name' => 'modal_password', 'change_name' => 'パスワード変更', 'btn_color' => 'primary', 'user_modal_content' => '
    <br><h3>パスワード変更</h3>
    <hr>
    <p>現在のパスワードと新しいパスワードを入力してください</p>
    <table>
        <tr>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>現在のパスワード::</td><td><input type="password" class="form-control" name="old_password" value=""></td>
        </tr>
        <tr>
            <td>新しいパスワード::</td><td><input type="password" class="form-control" name="new_password" value=""></td>
        <tr>
        <tr>
            <td>新しいパスワードの確認::</td><td><input type="password" class="form-control" name="new_password_check" value=""></td>
        </tr>
    </table>
    <label><input type="submit" class="btn btn-primary" name="send" value="変更"> </label>
    '
])