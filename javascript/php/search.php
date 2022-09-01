<?php

    include_once 'config.php';
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);   // SQLで設定された文字コードに元に文字列のエスケープを行う
    $output = '';
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE lname LIKE '%{$searchTerm}%' OR fname LIKE '%{$searchTerm}%' ");

    if(mysqli_num_rows($sql) > 0) {
        include 'data.php';
    } else {
        $output .= '検索したユーザーは見つかりませんでした。';
    }
    echo $output;
?>

