<?php
    while($row = mysqli_fetch_assoc($sql)) {
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']}) 
                                        AND (incoming_msg_id = {$outgoing_id} OR outgoing_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1" ;
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if(mysqli_num_rows($query2) > 0) {
            $result = $row2['msg'];
            // 最後のメッセージが自身なら「YOU」をつける。
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = 'YOU : ' : $you = "";
        }else {
            $result = '未投稿';
            $you = "";
        }

        // 表示する文字の長さを調整する。
        (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;
        // ユーザーがオンラインかオフラインかを表示する
        ($row['status'] == 'Offline now') ? $offline = 'offline' : $offline = '';

        $output .=  '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                        <div class="content">
                            <img src="javascript/php/images/' . $row['img'] . '" alt="">
                            <div class="details">
                                <span>' . $row['lname'] . ' ' . $row['fname'] . '</span>
                                <p>' . $you . $msg . '</p>
                            </div>
                        </div>
                        <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                    </a>';
    }
?>