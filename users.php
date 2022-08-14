<?php
    session_start();
    if (!isset($_SESSION['unique_id'])) {
        header('location: login.php');
    }
?>
<?php include_once 'header.php'; ?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                include_once 'javascript/php/config.php';
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <div class="content">
                    <img src="javascript/php/images/<?php echo $row['img'] ?>" alt="プロフィール写真">
                    <div class="details">
                        <span><?php echo $row['lname'] . ' ' . $row['fname']?></span>
                        <p><?php echo $row['status'] ?></p>
                    </div>
                </div>
                <a href="#" class="logout">LOG OUT</a>
            </header>
            <div class="search">
                <span class="text">チャット相手を選んでください。</span>
                <input type="text" placeholder="探す名前を入力">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                
            </div>
        </section>
    </div>
    <script src="./javascript/users.js"></script>
</body>
</html>

