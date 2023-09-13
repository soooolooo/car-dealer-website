<?php
    include 'head.php';
    include 'header.php';
    include 'dbh.inc.php';
?>

<main dir="rtl">
    <div class="title">
        <h1>الصفحة الرئيسية</h1>
    </div>
    <div class="car-container">
        <?php
            if (isset($_GET["id"])){
                $id = $_GET["id"];
                $images = array();
                $sql = "SELECT * FROM cars WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0){
                    $row = $result->fetch_assoc();
                    for ($k = 1; $k <= 8; $k++){
                        if (strlen($row['img'.$k.'']) != 0 ){
                            $images[$k-1] = $row['img'.$k.''];
                        }
                    }
                    sort($images);

                    echo 
                    '<div class="car-images">';
                    for ($l = 0; $l < count($images); $l++){
                        if (strlen($images[$l]) != 0){
                            echo '<img src="gfx/cars/'.$images[$l].'">';
                        }
                    }
                    echo 
                    '</div>
                    <div class="car-info">
                        <div class="car-info-more">
                            <h3>معلومات عن السيارة</h3>
                            <p>الشركة المصنعة: '.$row['brand'].'</p>
                            <p>الإسم: '.$row['car_name'].'</p>
                            <p>الموديل : '.$row['model'].'</p>
                            <p>الألوان المتوفرة: '.$row['colors'].'</p>
                            <p>الممشى : '.$row['roadtrip'].' كيلو</p>
                            <p>القير : '.$row['gearbox'].'</p>
                            <p>الفئة : '.$row['tier'].'</p>
                            <p>نوع الوقود : '.$row['petrol'].'</p>
                            <p>النوع : '.$row['category'].'</p>';
                            if ($row['price'] == 0){
                                echo '<p>السعر : عند الإتصال</p>';
                            }
                            else{
                                echo '<p>السعر : '.$row['price'].' ريال </p>';
                            }
                        echo '
                        </div>
                        <div class="car-details">
                        <details style="text-align: right; float: left;">
                                <summary>اضغط هنا لإظهار المواصفات</summary>
                                <p style="white-space:pre;">'.$row['car_info'].'</p>
                        </details>
                        </div>
                    ';
                }
                
            }
        ?>
    
    
        <!-- <div class="car-images">
            <img src="gfx/cars/1.jpg">
            <img src="gfx/cars/2.jpg">
            <img src="gfx/cars/3.jpg">
        </div>
        <div class="car-info">
            <div class="car-info-more">
            <h3>معلومات عن السيارة</h3>
                <p>السيارة المصنعة: تويوتا</p>
                <p>نوع السيارة: لاندكروزر</p>
                <p>موديل السيارة: 2019</p>
                <p>ممشى السيارة: 0 كيلو</p>
                <details style="text-align: right;">
                    <summary>انقر هنا لإظهار المواصفات</summary>
                    <p></p>
                </details>
            </div> -->
                <div class="contact-info">
                <p style="text-align: center; margin-bottom: 20px;">ارقام التواصل:</p><br>
                    <?php
                        $sql = "SELECT * FROM contacts";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck > 0){
                            while ($row = $result->fetch_assoc()){
                                echo '<p>'.$row['contact_name'].' : 0'.$row['phone_number'].'</p>';
                            }
                        }
                    ?>
                    
                    <!-- <p>اسامة: 0553901304</p>
                    <p>اسامة: 0553901304</p>
                    <p>اسامة: 0553901304</p>
                    <p>اسامة: 0553901304</p> -->
                </div>
        </div>
    </div>
</main>

<?php
    mysqli_close($conn);
    include 'footer.php';
?>