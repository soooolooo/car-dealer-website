<?php
    include 'head.php';
    include 'header.php';
?>

<main>
    <div class="admin-container">
        <!-- <?php
            if (isset($_GET['id'])){

            }

            else{
                $sql;
                $images;
                echo '
                <a href="offers.php?id='.$row['id'].'">
                    <div class="advert">
                    <div class="advert-title">
                        <p>'.$row['title'].'</p>
                    </div>
                    <div class="advert-background" style="background-image: url(gfx/adverts/'.$row[$img1].'.png);">
                    </div>
                </div>
                </a>
                ';
            }
        ?> -->
    
        <a href="offers.php">
        <div class="car">
            <div class="car-title">
                <p>test</p>
            </div>
            <div class="car-background" style="background-image: url(gfx/aboutus/1.jpg);">
            </div>
        </div>
        </a>
    </div>
</main>

<?php
    include 'footer.php';
?>