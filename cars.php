<?php
    include 'head.php';
    include 'header.php';
    include 'dbh.inc.php';
?>

<main>
    <div class="title">
        <h1>الصفحة البراندات</h1>
    </div>
    <div class="brand-container" dir="rtl">
    <?php
        if (isset($_GET["brand"])){
            $brand = $_GET["brand"];
            $sql = "SELECT * FROM cars WHERE brand='$brand'";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                for ($j = 1; $j <= $resultCheck; $j++){
                    $row = $result->fetch_assoc();
                    $img;
                    if (strlen($row['img1']) != 0){$img = $row['img1'];}
                    else if (strlen($row['img2']) != 0){$img = $row['img2'];}
                    else if (strlen($row['img3']) != 0){$img = $row['img3'];}
                    else if (strlen($row['img4']) != 0){$img = $row['img4'];}
                    else if (strlen($row['img5']) != 0){$img = $row['img5'];}
                    else if (strlen($row['img6']) != 0){$img = $row['img6'];}
                    else if (strlen($row['img7']) != 0){$img = $row['img7'];}
                    else if (strlen($row['img8']) != 0){$img = $row['img8'];}
                    else{$img = 'no-picture.png';}
                    $price;
                    if ($row['price'] > 0){$price = $row['price'].' ريال ';}
                    else if ($row['price'] <= 0){$price = 'السعر عند التواصل';}
                    echo '
                    <a href="carpage.php?id='.$row['id'].'">
                        <div class="car">
                            <div class="car-title">
                                <p> '.$row['brand'].' '.$row['car_name'].' '.$row['model'].' </p>
                            </div>
                            <div class="car-background" style="background-image: url(gfx/cars/'.$img.');">
                            </div>
                            <div class="car-title-bottom">
                            <p>'.$price.'</p>
                            </div>
                        </div>
                    </a>
                    ';
                }
            }
        }
        else{
            $brands = array();
            $brands_en = array();
            $sql = "SELECT cars.brand, brands.brand, brands.brand_en FROM cars, brands WHERE cars.brand = brands.brand";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                while($row = $result->fetch_assoc()){
                    if(!in_array($row['brand'], $brands)){
                        array_push($brands, $row['brand']);
                        array_push($brands_en, $row['brand_en']);
                    }
                }
                // sort($brands);
                for ($i = 0; $i < count($brands); $i++){
                    echo
                    '<a href="cars.php?brand='.$brands[$i].'">
                    <div class="brand">
                        <div class="brand-title">
                            <p>'.$brands[$i].'</p>
                        </div>
                        <div class="brand-background" style="background-image: url(gfx/brand/'.$brands_en[$i].'.png);">
                        </div>
                    </div>
                    </a>';
                }
            }
        }
    ?>
        <!-- 
        <a href="">
            <div class="car">
                <div class="car-title">
                    <p>2019 تويوتا لاندكروزر</p>
                </div>
                <div class="car-background">
                </div>
                <div class="car-title-bottom">
                    <p>280000 ريال</p>
                </div>
            </div>
        </a>    
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>تويوتا</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/toyota.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>مازدا</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/mazda.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>شفروليه</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/chevrolet.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>هيونداي</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/hyundai.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>نيسان</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/nissan.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>كيا</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/kia.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>جي ام سي</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/gmc.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>فورد</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/ford.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>دودج</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/dodge.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>هوندا</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/honda.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>لاندروفر</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/landrover.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>بي ام دبليو</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/bmw.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>مرسيديس</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/mercedes.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>اودي</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/audi.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>ميتسوبيشي</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/mutsubishi.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>ايسوزو</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/isuzu.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>ميني كوبر</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/minicooper.png);">
                </div>
            </div>
        </a>
        <a href="">
            <div class="brand">
                <div class="brand-title">
                    <p>فيات</p>
                </div>
                <div class="brand-background" style="background-image: url(gfx/brand/fiat.png);">
                </div>
            </div>
        </a> -->
    </div>
</main>

<?php
    mysqli_close($conn);
    include 'footer.php';
?>