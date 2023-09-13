<?php
    session_start();
?>

<header>
    <div class="dealer-logo">
        <a href="index.php">
            <img src="gfx/testlogo.png">
        </a>
    </div>
    <div class="nav-bar">
        <?php
            if (isset($_SESSION['username'])){
                echo '
                <a href="logout.php">
                    <div class="nav">
                        <p>تسجيل الخروج</p>
                    </div>
                </a>
                ';

                echo '
                <a href="admin.php">
                    <div class="nav">
                        <p>لوحة التحكم</p>
                    </div>
                </a>
                ';
            }
        ?>
        <a href="contactus.php">
            <div class="nav">
                <p>تواصل معنا</p>
            </div>
        </a>
        <a href="aboutus.php">
            <div class="nav">
                <p>من نحن</p>
            </div>
        </a>
        <a href="offers.php">
            <div class="nav">
                <p>عروضنا</p>
            </div>
        </a>
        <a href="cars.php">
            <div class="nav">
                <p>السيارات</p>
            </div>
        </a>
        <a href="index.php">
            <div class="nav">
                <p>الرئيسية</p>
            </div>
        </a>
    </div>
</header>