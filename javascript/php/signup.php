<?php
    session_start();
    include_once 'config.php';
    // インジェクションSQL対策で入力文字をサニタライズする為に”mysqli_real_escape_string”をしようしているが
    // 第一引数にSQLオブジェクトを渡しているのは、mysqli…関数を使用するのにmysqliクラスを渡さないと実行出来ない為
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);         // インジェクションSQL対策
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);         // htmlspacialchars()
    $email = mysqli_real_escape_string($conn, $_POST['email']);         // htmlspacialchars()
    $password = mysqli_real_escape_string($conn, $_POST['password']);   // htmlspacialchars()

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
        // 有効なメールアドレスか調べる
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {                // メールアドレスのバリデーション
            // 入力されたメールがDBに登録されていないか確認する
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0) {                            // mysqli_num_rows：DBに同じメールのレコードがある場合そのレコードの数を返す
                echo 'すでに ' . $email . ' は登録されています。';
            }else {
                // 選択されたイメージファイルが有効か確認する
                if (isset($_FILES['image'])) {                          // $_FILESは指定したファイル名の情報を連想配列で返す
                    $img_name = $_FILES['image']['name'];               // imageファイルの名前を「enctype属性をmultipart/form-data」にし、<input>タグで「type属性をfile」で送信されたデータが、HTTP POSTメソッドでアップロードされたファイルデータの変数にな取得する
                    $tmp_name = $_FILES['image']['tmp_name'];           // 一時的にimageファイルが保存されるファイルパスを取得

                    // 画像ファイル名を分解して拡張子部分を抽出する
                    $img_explode = explode('.', $img_name);             // "."の部分で分割して配列として格納する
                    $img_ext = end($img_explode);                       // アップロードされたファイルの拡張子を格納する

                    $extensions = ['png', 'jpg', 'jpeg'];               // 画像ファイルであるかの照合指標として画像拡張子を配列として格納
                    if (in_array($img_ext, $extensions)) {              // 選択したファイルが設定した画像拡張子であるかを判定
                        $time = time();                                 // 現在の時間を取得
                                                                        // アップロードされた画像を「現在時間」+ . +「ファイル名」に設定するために時間の取得を行っている
                                                                        // 一意のimageファイル名にする為に時間を名前にする
                        // アップロードファイルは一時的に保存されるtmpフォルダ等にほぞんされているので一定時間が経過すると削除されるので
                        // 特定のフォルダに移動する必要がある。その時にファイルを移動させる関数が「move_uploaded_file()」関数
                        $new_img_name = $time.$img_name;                // 時間＋ファイル名で一意のファイル名を生成する。

                        if (move_uploaded_file($tmp_name, 'images/'.$new_img_name)) {

                            $status = 'Active now';                     // サインアップするとアクティブ状態になる
                            $random_id = rand(time(), 10000000);        // unique_id用のランダムのIDを生成する
                            // DBにユーザーの情報を登録する
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                                                      VALUE ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                            if ($sql2) { //登録が完了した場合
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_num_rows($sql3) > 0) {
                                    $row = mysqli_fetch_assoc($sql3);   // sql3の結果を受け取る
                                    // セッションにunique_idを設定する
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo 'success';
                                }
                            }else {
                                echo 'エラーが発生しました！';
                            }
                        }

                    }else {
                        echo 'jpeg, png, jpg のいずれかの画像ファイルを選択してください。';
                    }

                }else {
                    echo '画像ファイルを選択してください。';
                }
            }
        }else {
            echo $email . ': メールを正しく入力してください。';
        }
    }else {
        echo 'すべての項目が入力必須項目です。';
    }

    
?>