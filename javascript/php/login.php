<?php
    session_start();
    include_once 'config.php';
    // インジェクションSQL対策で入力文字をサニタライズする為に”mysqli_real_escape_string”をしようしているが
    // 第一引数にSQLオブジェクトを渡しているのは、mysqli…関数を使用するのにmysqliクラスを渡さないと実行出来ない為
    $email = mysqli_real_escape_string($conn, $_POST['email']);         // htmlspacialchars()
    $password = mysqli_real_escape_string($conn, $_POST['password']);   // htmlspacialchars()

    if (!empty($email) && !empty($password)) {
        // 入力されたメールとパスワードが有効かDBから認証を行う。
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
        if (mysqli_num_rows($sql) > 0) {     //メールとパスワードが一致した場合
            $row = mysqli_fetch_assoc($sql);
            $status = 'Active now';
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            if($sql2) {
                $_SESSION['unique_id'] = $row['unique_id'];
                echo 'success';
            }
        }else {
            echo '認証エラーが発生しました。';
        }
    }else {
        echo 'すべての項目を入力してください。';
    }
?>