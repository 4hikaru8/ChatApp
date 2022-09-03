<?php
    session_start();
    if(isset($_SESSION['unique_id'])) {
        header('location: users.php');
    }
?>

<?php include_once 'header.php'; ?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Chat Square</header>
            <form action="#">
                <div class="error-txt"></div>
                <div class="field input">
                    <label>メール</label>
                    <input type="text" name="email" placeholder="メール" required>
                </div>
                <div class="field input">
                    <label>パスワード</label>
                    <input type="password" name="password" placeholder="パスワード" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="submit" value="Continu to Chat">
                </div>
            </form>
            <div class="link">初めての方はこちら→<a href="index.php">SIGN UP</a></div>
        </section>
    </div>
    
    <script src="./javascript/pass-show-hide.js"></script>
    <script src="./javascript/login.js"></script>

</body>
</html>