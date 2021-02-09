@include('components/user_change', ['modal_name' => 'modal_social', 'change_name' => 'ソーシャルID変更', 'btn_color' => 'primary', 'user_modal_content' => '
    <br><h3>ソーシャルID変更</h3>
    <hr>
    <p>新しいソーシャルIDを入力してください</p>
    <table>
        <tr>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>新しいソーシャルID::</td><td><input type="text" class="form-control" name="new_social" value=""></td>
        <tr>
        <tr>
            <td>新しいソーシャルIDの確認::</td><td><input type="text" class="form-control" name="new_social_confirmation" value=""></td>
        </tr>
    </table>
    <label><input type="submit" class="btn btn-primary" name="send" value="変更"> </label>
    '
])