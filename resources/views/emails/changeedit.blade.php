
<html>
    <head>
        <meta charset="utf-8">
        <title>パスワード変更ページ　/　Spotlight</title>
    </head>

        <p>今のパスワードと新しいパスワードを入力してください</p>
        <form action="changeupdate" method="POST">
            @csrf
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>今のパスワード::</td><td><input type="password" name="old_password" value=""></td>
                </tr>
                <tr>
                    <td>新しいパスワード::</td><td><input type="password" name="new_password" value=""></td>
                <tr>
                <tr>
                    <td>新しいパスワードの確認::</td><td><input type="password" name="new_password_check" value=""></td>
                </tr>
            </table>
            <label><input type="submit" name="send" value="変更"> </label>

        </form>
</html>
