<?php
    session_start();
    if (isset($_SESSION['unique_id'])) {
        include_once 'config.php';
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output ='';

        $sql = "SELECT * FROM messages
                LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (incoming_msg_id = $incoming_id AND outgoing_msg_id = $outgoing_id) 
                OR (incoming_msg_id = $outgoing_id AND outgoing_msg_id = $incoming_id) ORDER BY msg_id";

        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                if($row['outgoing_msg_id'] === $outgoing_id) { 
                    // 送信者
                    $output .= '<div class="chat outgoing">
                                    <p class="reed">Reed</p>
                                    <div class="details">
                                        <p>' . $row['msg'] . '</p>
                                    </div>
                                </div>';
                }else {
                    // 受信者
                    $output .= '<div class="chat incoming">
                                    <img src="javascript/php/images/' . $row['img'] . '" alt="">
                                    <div class="details">
                                        <p>' . $row['msg'] . '</p>
                                    </div>
                                </div>';
                }
            }
        }
        echo $output;
        
    }else {
        header('location: ../../login.php');
    }
?>