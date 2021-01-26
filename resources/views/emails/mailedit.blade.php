
<html>
    <head>
        <meta charset="utf-8">
        <title>メールアドレス変更ページ　/　Spotlight</title>
    </head>

        <p>今のメールアドレスと新しいメールアドレスを入力してください</p>
        <form action="socialupdate" method="POST">
            @csrf
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>今のメールアドレス::</td><td><input type="text" name="old_mail" value=""></td>
                </tr>
                <tr>
                    <td>新しいメールアドレス::</td><td><input type="text" name="new_mail" value=""></td>
                <tr>
                <tr>
                    <td>新しいメールアドレスの確認::</td><td><input type="text" name="new_mail_check" value=""></td>
                </tr>
            </table>
            <label><input type="submit" name="send" value="変更"> </label>

        </form>
</html>
