<?php
    session_start();
    if (!isset($_SESSION['unique_id'])) {
        header('location: login.php');
    }
?>

<!-- 2:01:07 -->

<?php include_once 'header.php'; ?>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                    include_once 'javascript/php/config.php';
                    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="javascript/php/images/<?php echo $row['img'] ?>" alt="">
                <div class="details">
                    <span><?php echo $row['lname'] . ' ' . $row['fname']?></span>
                    <p><?php echo $row['status'] ?></p>
                </div>
            </header>
            <div class="chat-box">
                <div class="chat outgoing">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="chat outgoing">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="chat outgoing">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="chat outgoing">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="chat outgoing">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>
            <form action="" class="typing-area">
                <input type="text" placeholder="メッセージを入力">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    
</body>
</html>