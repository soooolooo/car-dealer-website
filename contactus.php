<?php
    include 'head.php';
    include 'header.php';
    include 'dbh.inc.php';
?>

<main>
    <div class="title">
        <h1>تواصل معنا</h1>
    </div>
    <div class="contact-container">
        <div class="social-container">
            <p>تواصل معنا عن طريق حساباتنا على مواقع التواصل الاجتماعي</p><br>
            <a href="">
                <div class="social">
                    <img src="gfx/social/instagramlogo.png">
                    <p>انستقرام</p>
                </div>
            </a>
            <a href="">
                <div class="social">
                    <img src="gfx/social/instagramlogo.png">
                    <p>انستقرام</p>
                </div>
            </a>
            <a href="">
                <div class="social">
                    <img src="gfx/social/instagramlogo.png">
                    <p>انستقرام</p>
                </div>
            </a>
        </div>
        <div class="social-container">
            <p>تواصل معنا عن طريق الواتس اب</p><br>
            <?php
                $sql = "SELECT * FROM contacts";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0){
                    while ($row = $result->fetch_assoc()){
                        echo '
                        <a href="https://wa.me/966'.$row['phone_number'].'">
                            <div class="social">
                                <img src="gfx/social/whatsapplogo.png">
                                <p style="margin-bottom: 10px;">'.$row['contact_name'].'</p>
                                <p>0'.$row['phone_number'].'</p>
                            </div>
                        </a>
                        ';
                    }
                }
            ?>
            <!-- <a href="">
                <div class="social">
                    <img src="gfx/social/whatsapplogo.png">
                    <p>أسامة</p>
                    <p>+966553901304</p>
                </div>
            </a>
            <a href="">
                <div class="social">
                    <img src="gfx/social/whatsapplogo.png">
                    <p>أسامة</p>
                    <p>+966553901304</p>
                </div>
            </a>
            <a href="">
                <div class="social">
                    <img src="gfx/social/whatsapplogo.png">
                    <p>أسامة</p>
                    <p>+966553901304</p>
                </div>
            </a> -->
        </div>
    </div>
</main>

<?php
    mysqli_close($conn);
    include 'footer.php';
?>