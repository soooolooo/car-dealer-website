<?php
    include 'head.php';
    include 'header.php';
    include 'dbh.inc.php';
?>

<main dir="rtl">
    <div class="title">
        <h1>الصفحة الرئيسية</h1>
    </div>
    <div class="welcome">
        <h1>مرحباً بك في الموقع الرسمي لمعرض السيارات</h1><br>
        <h2>هنا ستجد احدث السيارات المعروضة لدينا بأفضل الأسعار</h2>
    </div>  
    <div class="cars-list">
        <h2>احدث السيارات في المعرض</h2>
        <?php
            $sql = "SELECT * FROM cars WHERE show_page = 1";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                while ($row = $result->fetch_assoc()){
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
                                <p>'.$row['brand'].' '.$row['car_name'].' '.$row['model'].'</p>
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
            // for ($minNumber; $minNumber <= 8; $minNumber++){
            //     $randomNumber = rand($minNumber,$maxNumber);
            //     $sql = "SELECT * FROM cars WHERE id = $randomNumber";
            //     $result = mysqli_query($conn, $sql);
            //     $resultCheck = mysqli_num_rows($result);
            //     if ($resultCheck > 0){
            //         $row = $result->fetch_assoc();
            //         if (!in_array($randomNumber, $usedNumbers)){
            //             array_push($usedNumbers, $randomNumber);
            //             $img;
            //             if (strlen($row['img1']) != 0){$img = $row['img1'];}
            //             else if (strlen($row['img2']) != 0){$img = $row['img2'];}
            //             else if (strlen($row['img3']) != 0){$img = $row['img3'];}
            //             else if (strlen($row['img4']) != 0){$img = $row['img4'];}
            //             else if (strlen($row['img5']) != 0){$img = $row['img5'];}
            //             else if (strlen($row['img6']) != 0){$img = $row['img6'];}
            //             else if (strlen($row['img7']) != 0){$img = $row['img7'];}
            //             else if (strlen($row['img8']) != 0){$img = $row['img8'];}
            //             $price;
            //             if ($row['price'] > 0){$price = $row['price'].' ريال ';}
            //             else if ($row['price'] <= 0){$price = 'السعر عند التواصل';}
            //             echo '
            //             <a href="carpage.php?id='.$row['id'].'">
            //                 <div class="car">
            //                     <div class="car-title">
            //                         <p>'.$row['brand'].' '.$row['car_name'].' '.$row['model'].'</p>
            //                     </div>
            //                     <div class="car-background" style="background-image: url(gfx/cars/'.$img.');">
            //                     </div>
            //                     <div class="car-title-bottom">
            //                     <p>'.$price.'</p>
            //                     </div>
            //                 </div>
            //             </a>
            //             ';
            //         }
            //     }
                
            // }
            // $sql = "SELECT * FROM cars";
            // $result = mysqli_query($conn, $sql);
            // $resultCheck = mysqli_num_rows($result);
            // if ($resultCheck > 0){
            //     for ($j = 1; $j <= $resultCheck; $j++){
            //         $row = $result->fetch_assoc();
            //         $img;
            //         if (strlen($row['img1']) != 0){$img = $row['img1'];}
            //         else if (strlen($row['img2']) != 0){$img = $row['img2'];}
            //         else if (strlen($row['img3']) != 0){$img = $row['img3'];}
            //         else if (strlen($row['img4']) != 0){$img = $row['img4'];}
            //         else if (strlen($row['img5']) != 0){$img = $row['img5'];}
            //         else if (strlen($row['img6']) != 0){$img = $row['img6'];}
            //         $price;
            //         if ($row['price'] > 0){$price = 'ريال '.$row['price'];}
            //         else if ($row['price'] <= 0){$price = 'السعر عند التواصل';}
            //         echo '
            //         <a href="carpage.php?id='.$row['id'].'">
            //             <div class="car">
            //                 <div class="car-title">
            //                     <p>'.$row['model'].' '.$row['brand'].' '.$row['car_name'].'</p>
            //                 </div>
            //                 <div class="car-background" style="background-image: url(gfx/cars/'.$img.');">
            //                 </div>
            //                 <div class="car-title-bottom">
            //                 <p>'.$price.'</p>
            //                 </div>
            //             </div>
            //         </a>
            //         ';
            //     }
            // }
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
        </a> -->
    </div>
    <div class="cars-list">
        <h3>البنوك المعتمدة في طرق الدفع</h3>
        <img src="gfx/brand/toyota.png">
        <img src="gfx/brand/toyota.png">
        <img src="gfx/brand/toyota.png">
    </div>
</main>

<?php
    mysqli_close($conn);
    include 'footer.php';
?>