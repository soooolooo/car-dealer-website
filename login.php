<?php
    include 'head.php';
    include 'header.php';
    include 'dbh.inc.php';
?>

<main>
    <div class="login-container">
        <p>صفحة تسجيل الدخول</p>
        <form action="handler.php" method="POST">
            <label>اسم المستخدم</label><br>
            <input type="text" name="username" placeholder="اسم المستخدم"><br>
            <label>كلمة المرور</label><br>
            <input type="password" name="passwrd" placeholder="كلمة المرور"><br>
            <?php
                if (isset($_GET['error'])){
                    echo '<label>عذراً, اسم المستخدم أو كلمة المرور خاطئة</label><br>';
                }
            ?>
            <button type="submit" name="login">تسجيل الدخول</button>
        </form>
    </div>
</main>

<?php
    include 'footer.php';
?>