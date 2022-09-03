<?php
    session_start();
    if(isset($_SESSION['unique_id'])) {
        header('location: users.php');
    }
?>

<?php include_once 'header.php'; ?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Chat Square</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>姓</label>
                        <input type="text" name="lname" placeholder="姓" required>
                    </div>
                    <div class="field input">
                        <label>名</label>
                        <input type="text" name="fname" placeholder="名" required>
                    </div>
                </div>
                <div class="field input">
                    <label>メール</label>
                    <input type="text" name="email" placeholder="メール" required>
                </div>
                <div class="field input">
                    <label>パスワード</label>
                    <input type="password" name="password" placeholder="パスワード" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>画像選択</label>
                    <input type="file" name="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Continu to Chat">
                </div>
            </form>
            <div class="link">登録済みの方はこちら→<a href="login.php">LOG IN</a></div>
        </section>
    </div>

    <script src="./javascript/pass-show-hide.js"></script>
    <script src="./javascript/signup.js"></script>
    
</body>
</html>