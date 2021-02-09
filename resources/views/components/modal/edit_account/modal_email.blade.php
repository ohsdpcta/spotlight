@include('components/user_change', ['modal_name' => 'modal_email', 'change_name' => 'メールアドレス変更', 'btn_color' => 'primary', 'user_modal_content' => '
    <br><h3>メールアドレス変更</h3>
    <hr>
    <p>新しいメールアドレスを入力してください</p>
    <table>
        <tr>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <div class="form-group">
                <td>新しいメールアドレス::</td><td><input type="text"  class="form-control" name="new_mail" value=""></td>
            </div>
        <tr>
        <tr>
            <div class="form-group">
                <td>新しいメールアドレスの確認::</td><td><input type="text" class="form-control" name="new_mail_confirmation" value=""></td>
            </div>
        </tr>
    </table>
    <label><input type="submit" class="btn btn-primary" name="send" value="変更"> </label>
    '
])