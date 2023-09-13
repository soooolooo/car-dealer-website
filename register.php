<?php
    include 'head.php';
    include 'header.php';
    include 'dbh.inc.php';
?>

<main>
    <div class="login-container">
        <p>صفحة التسجيل</p>
        <form action="handler.php" method="POST">
            <label>اسم المستخدم</label><br>
            <input type="text" name="username" placeholder="اسم المستخدم"><br>
            <label>كلمة المرور</label><br>
            <input type="password" name="passwrd" placeholder="كلمة المرور"><br>
            <label>كلمة المرور مرة اخرى</label><br>
            <input type="password" name="passwrd2" placeholder="كلمة المرور"><br>
            <button type="submit" name="register">تسجيل</button>
        </form>
    </div>
</main>

<?php
    include 'footer.php';
?>