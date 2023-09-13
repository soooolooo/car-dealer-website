<?php
    include 'head.php';
    include 'header.php';
    include 'dbh.inc.php';

    if (!isset($_SESSION["username"])){
        header('location: index.php');
    }

    
?>
<script>
    if (screen.width < 450){
        location.replace("logout.php");
    }
</script>
<main dir="rtl">
    <div class="admin-container">
        <?php
            if (isset($_GET['success'])){
                echo '<h2 style="margin-bottom: 30px;">تمت العملية بنجاح!</h2>';
            }

            else if (isset($_GET['editContact'])){
                $id = $_GET['editContact'];
                $sql = "SELECT * FROM contacts WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0){
                    $row = $result->fetch_assoc();

                    echo '
                    <details>
                        <summary>تعديل على معلومات التواصل</summary>
                        <form action="handler.php" method="POST">
                            <label>الإسم</label><br>
                            <input type="text" name="contactName" value="'.$row['contact_name'].'" required><br>
                            <label>رقم الجوال</label><br>
                            <input type="text" name="phoneNumber" value="'.$row['phone_number'].'" required><br>
                            <input type="hidden" name="id" value="'.$row['id'].'">
                            <button type="submit" name="editContact">تعديل</button>
                        </form>
                    </details>
                    ';
                }
                else {
                    echo '<h2>عفواً, البيانات المطلوب تعديلها غير موجودة</h2>';
                }
                
            }

            else if (isset($_GET['editCar'])){
                $id = $_GET['editCar'];
                $brand;
                $sql = "SELECT brand FROM cars WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                $row = $result->fetch_assoc();
                $brand = $row['brand'];
                echo '
                <details>
                    <summary>تعديل سيارة معروضة</summary>
                    <form action="handler.php" method="POST">
                        <input type="hidden" name="id" value="'.$id.'">
                        <label>اختر براند السيارة</label><br>
                        <select name="brand" required>';

                $sql = "SELECT brand from brands";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0){
                    while($row = $result->fetch_assoc()){
                        if ($row['brand'] == $brand){
                            echo '<option value="'.$row['brand'].'" selected>'.$row['brand'].'</option>';
                        }
                        else{
                            echo '<option value="'.$row['brand'].'">'.$row['brand'].'</option>';
                        }
                    }
                }
                echo '</select><br>';
                        
                $sql = "SELECT * FROM cars WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0){
                    $row = $result->fetch_assoc();
                    echo '
                        <label>ادخل اسم السيارة</label><br>
                        <input type="text" name="car_name" value="'.$row['car_name'].'"><br>
                        <label>اختر موديل السيارة</label><br>
                        <select name="model">
                    ';
                    for ($v = 2021; $v >= 1970; $v--){
                        if ($row['model'] == $v){
                            echo '<option value="'.$v.' selected">'.$v.'</option>';
                        }
                        else{
                            echo '<option value="'.$v.'">'.$v.'</option>';
                        }
                    }
                }
                echo '
                        </select><br>
                        <label>اختر الوان السيارة</label><br>';
                        $sql = "SELECT colors FROM cars WHERE id = $id";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        $colorsUsed = explode(' - ', $row['colors']);

                        $sql = "SELECT * FROM colors";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck > 0){
                            for ($u = 0; $u < $resultCheck; $u++){
                                $row = $result->fetch_assoc();
                                if (in_array($row['color'], $colorsUsed)){
                                    echo '
                                    <label style="margin-right: 10px;">'.$row['color'].'</label>
                                    <input type="checkbox" name="color'.$u.'" value="'.$row['color'].'" checked>
                                ';
                                }
                                else {
                                    echo '
                                    <label style="margin-right: 10px;">'.$row['color'].'</label>
                                    <input type="checkbox" name="color'.$u.'" value="'.$row['color'].'">
                                    ';
                                }
                                
            
                                if (($u % 5) == 0){
                                    echo '<br>';
                                }
                            }
                        }
                        $sql = "SELECT * FROM cars WHERE id = $id";
                            $result = mysqli_query($conn, $sql);
                            $resultCheck = mysqli_num_rows($result);
                            $row = $result->fetch_assoc();
                echo'
                        <label>ادخل ممشى السيارة</label><br>
                        <input type="text" name="roadtrip" value="'.$row['roadtrip'].'"><br>
                        <label>ادخل مواصفات السيارة</label><br>
                        <label>(الحد الاقصى 256 حرف)</label><br>';
                        //if (isset($row['car_info'])){
                            echo '<textarea rows="15" cols="30" name="car_info" max="256">'.$row['car_info'].'</textarea><br>';
                        //}
                        // else {
                        //     echo '<textarea rows="15" cols="30" name="car_info" max="256" value=""></textarea><br>';
                        // }
                echo'
                        <label>نوع القير</label><br>
                        <select name="gearbox" required>';
                            if ($row['gearbox'] == 'اوتوماتيك'){
                                echo '<option value="اوتوماتيك" selected>اوتوماتيك</option>';
                                echo '<option value="عادي">عادي</option>';
                            }
                            else {
                                echo '<option value="اوتوماتيك">اوتوماتيك</option>';
                                echo '<option value="عادي" selected>عادي</option>';
                            }
                        echo '
                        </select><br>
                        <label>فئة السيارة</label><br>
                        <input type="text" name="tier" placeholder="الفئة" value="'.$row['tier'].'" required><br>
                        <label>نوع الوقود</label><br>
                        <select name="petrol" required><br>';
                            if ($row['petrol'] == 'بنزين'){
                                echo '
                                <option value="بنزين" selected>بنزين</option>
                                <option value="ديزل">ديزل</option>
                                <option value="كهرباء">كهرباء</option>
                                ';
                            }
                            else if ($row['petrol'] == 'ديزل'){
                                echo '
                                <option value="بنزين" >بنزين</option>
                                <option value="ديزل" selected>ديزل</option>
                                <option value="كهرباء">كهرباء</option>
                                ';
                            }
                            else{
                                echo '
                                <option value="بنزين" >بنزين</option>
                                <option value="ديزل">ديزل</option>
                                <option value="كهرباء" selected>كهرباء</option>
                                ';
                            }
                            echo '
                        </select><br>
                        <label>حجم السيارة</label><br>
                        <select name="category" required>';
                            if ($row['category'] == 'سيدان'){
                                echo '
                                <option value="سيدان" selected>سيدان</option>
                                <option value="جيب">جيب</option>
                                <option value="بيك اب">بيك اب</option>
                                <option value="هاتشباك">هاتشباك</option>
                                <option value="كوبيه">كوبيه</option>
                                <option value="سوبركار">سوبركار</option>
                                ';
                            }
                            else if ($row['category'] == 'جيب'){
                                echo '
                                <option value="سيدان" >سيدان</option>
                                <option value="جيب" selected>جيب</option>
                                <option value="بيك اب">بيك اب</option>
                                <option value="هاتشباك">هاتشباك</option>
                                <option value="كوبيه">كوبيه</option>
                                <option value="سوبركار">سوبركار</option>
                                ';
                            }
                            else if ($row['category'] == 'بيك اب'){
                                echo '
                                <option value="سيدان" >سيدان</option>
                                <option value="جيب">جيب</option>
                                <option value="بيك اب" selected>بيك اب</option>
                                <option value="هاتشباك">هاتشباك</option>
                                <option value="كوبيه">كوبيه</option>
                                <option value="سوبركار">سوبركار</option>
                                ';
                            }
                            else if ($row['category'] == 'هاتشباك'){
                                echo '
                                <option value="سيدان" >سيدان</option>
                                <option value="جيب">جيب</option>
                                <option value="بيك اب">بيك اب</option>
                                <option value="هاتشباك" selected>هاتشباك</option>
                                <option value="كوبيه">كوبيه</option>
                                <option value="سوبركار">سوبركار</option>
                                ';
                            }
                            else if ($row['category'] == 'كوبيه'){
                                echo '
                                <option value="سيدان" >سيدان</option>
                                <option value="جيب">جيب</option>
                                <option value="بيك اب">بيك اب</option>
                                <option value="هاتشباك">هاتشباك</option>
                                <option value="كوبيه" selected>كوبيه</option>
                                <option value="سوبركار">سوبركار</option>
                                ';
                            }
                            else if ($row['category'] == 'سوبركار'){
                                echo '
                                <option value="سيدان" >سيدان</option>
                                <option value="جيب">جيب</option>
                                <option value="بيك اب">بيك اب</option>
                                <option value="هاتشباك">هاتشباك</option>
                                <option value="كوبيه">كوبيه</option>
                                <option value="سوبركار" selected>سوبركار</option>
                                ';
                            }
                        echo '
                        </select><br>
                        <label>سعر السيارة (0 في حال السعر عند الاتصال)</label><br>
                        <input type="text" name="price" value="'.$row['price'].'" required><br>
                        <label>ارفع صور السيارة (صورة لكل خانة رفع)</label><br><br>
                        <label>(صورة أمامية)</label><br>
                        <input type="file" id="img1" name="img1" accept="image/*"><br>
                        <label>(صورة خلفية)</label><br>
                        <input type="file" id="img2" name="img2" accept="image/*"><br>
                        <label>(صورة جانبية 1)</label><br>
                        <input type="file" id="img3" name="img3" accept="image/*"><br>
                        <label>(صورة جانبية 2)</label><br>
                        <input type="file" id="img4" name="img4" accept="image/*"><br>
                        <label>(1 صورة داخلية)</label><br>
                        <input type="file" id="img5" name="img5" accept="image/*"><br>
                        <label>(2 صورة داخلية)</label><br>
                        <input type="file" id="img6" name="img6" accept="image/*"><br>
                        <label>(3 صورة داخلية)</label><br>
                        <input type="file" id="img7" name="img7" accept="image/*"><br>
                        <label>(صورة لبطاقة صرفية الوقود)</label><br>
                        <input type="file" id="img8" name="img8" accept="image/*"><br>
                        <label>هل تود عرض هذه السيارة في الصفحة الرئيسية؟</label><br>
                        <label>نعم</label>';
                            if ($row['show_page'] == 1){
                                echo '<input type="radio" name="showPage" value="1" checked><br>';
                            }
                            else {
                                echo '<input type="radio" name="showPage" value="1"><br>';
                            }
                        echo '<label>لا</label>';
                        if ($row['show_page'] == 0){
                            echo '<input type="radio" name="showPage" value="0" checked><br>';
                        }
                        else {
                            echo '<input type="radio" name="showPage" value="0"><br>';
                        }
                        echo '
                        <button type="submit" name="editCar">اضافة</button>
                    </form>
                </details>
                ';
            }
        ?>
        <h2>قوائم الإضافات</h2>
        <details>
            <summary>اضف سيارة جديدة</summary><br>
            <form action="handler.php" method="POST" enctype="multipart/form-data">
                <label>اختر براند السيارة</label><br>
                <select name="brand" required>
                    <?php
                        $sql = "SELECT brand from brands";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck > 0){
                            while($row = $result->fetch_assoc()){
                                echo '<option value"'.$row['brand'].'">'.$row['brand'].'</option>';
                            }
                        }
                    ?>
                    <!-- <option value="تويوتا">تويوتا</option>
                    <option value="نيسان">نيسان</option>
                    <option value="مازدا">مازدا</option>
                    <option value="هيونداي">هيونداي</option>
                    <option value="كيا">كيا</option>
                    <option value="شفروليه">شفروليه</option>
                    <option value="جي ام سي">جي ام سي</option>
                    <option value="فورد">فورد</option>
                    <option value="هوندا">هوندا</option>
                    <option value="دودج">دودج</option>
                    <option value="لاندروفر">لاندروفر</option>
                    <option value="بي ام دبليو">بي ام دبليو</option>
                    <option value="مرسيدس">مرسيدس</option>
                    <option value="اودي">اودي</option>
                    <option value="ميتسوبيشي">ميتسوبيشي</option>
                    <option value="ايسوزو">ايسوزو</option>
                    <option value="ميني كوبر">ميني كوبر</option>
                    <option value="فيات">فيات</option>
                    <option value="تشانجان">تشانجان</option> -->
                </select><br>
                <label>ادخل اسم السيارة</label><br>
                <input type="text" name="car_name" placeholder="اسم السيارة" required><br>
                <label>اختر موديل السيارة</label><br>
                <select name="model" required>
                    <?php
                        for($e = 2021; $e >= 1970; $e--){
                            echo '<option value="'.$e.'">'.$e.'</option>';
                        }
                    ?>
                </select><br>
                <label>اختر الوان السيارة</label><br>
                <?php
                $sql = "SELECT * FROM colors";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0){
                    for ($u = 0; $u < $resultCheck; $u++){
                        $row = $result->fetch_assoc();
                        echo '
                            <label style="margin-right: 10px;">'.$row['color'].'</label>
                            <input type="checkbox" name="color'.$u.'" value="'.$row['color'].'">
                        ';
    
                        if (($u % 5) == 0){
                            echo '<br>';
                        }
                    }
                }
                ?>
                <label>ادخل ممشى السيارة (دعها 0 اذا كانت جديدة)</label><br>
                <input type="text" name="roadtrip" value="0" required><br>
                <label>ادخل مواصفات السيارة</label><br>
                <label>(الحد الاقصى 256 حرف)</label><br>
                <textarea rows="15" cols="30" name="car_info" max="256"></textarea><br>
                <label>نوع القير</label><br>
                <select name="gearbox" required>
                    <option value="اوتوماتيك">اوتوماتيك</option>
                    <option value="عادي">عادي</option>
                </select><br>
                <label>فئة السيارة</label><br>
                <input type="text" name="tier" placeholder="الفئة" required><br>
                <label>نوع الوقود</label><br>
                <select name="petrol" required><br>
                    <option value="بنزين">بنزين</option>
                    <option value="ديزل">ديزل</option>
                    <option value="كهرباء">كهرباء</option>
                </select><br>
                <label>حجم السيارة</label><br>
                <select name="category" required>
                    <option value="سيدان">سيدان</option>
                    <option value="جيب">جيب</option>
                    <option value="بيك اب">بيك اب</option>
                    <option value="هاتشباك">هاتشباك</option>
                    <option value="كوبيه">كوبيه</option>
                    <option value="سوبركار">سوبركار</option>
                </select><br>
                <label>سعر السيارة (0 في حال السعر عند الاتصال)</label><br>
                <input type="text" name="price" value="0" required><br>
                <label>ارفع صور السيارة (صورة لكل خانة رفع)</label><br><br>
                <label>(صورة أمامية)</label><br>
                <input type="file" id="img1" name="img1" accept="image/*"><br>
                <label>(صورة خلفية)</label><br>
                <input type="file" id="img2" name="img2" accept="image/*"><br>
                <label>(صورة جانبية 1)</label><br>
                <input type="file" id="img3" name="img3" accept="image/*"><br>
                <label>(صورة جانبية 2)</label><br>
                <input type="file" id="img4" name="img4" accept="image/*"><br>
                <label>(1 صورة داخلية)</label><br>
                <input type="file" id="img5" name="img5" accept="image/*"><br>
                <label>(2 صورة داخلية)</label><br>
                <input type="file" id="img6" name="img6" accept="image/*"><br>
                <label>(3 صورة داخلية)</label><br>
                <input type="file" id="img7" name="img7" accept="image/*"><br>
                <label>(صورة لبطاقة صرفية الوقود)</label><br>
                <input type="file" id="img8" name="img8" accept="image/*"><br>
                <label>هل تود عرض هذه السيارة في الصفحة الرئيسية؟</label><br>
                <label>نعم</label>
                <input type="radio" name="showPage" value="1"><br>
                <label>لا</label>
                <input type="radio" name="showPage" value="0"><br>
                <button type="submit" name="addCar">اضافة</button>
            </form>
        </details>
        <details>
            <summary>إضافة معلومات تواصل جديدة</summary>
            <form action="handler.php" method="POST">
            <label>الإسم</label><br>
            <input type="text" name="contactName" required><br>
            <label>رقم الجوال (بدون اول صفر)</label><br>
            <input type="text" name="phoneNumber" required><br>
            <button type="submit" name="addContact">اضافة</button>
            </form>
        </details>
        <details>
            <summary>إضافة لون جديد</summary>
            <form action="handler.php" method="POST">
                <label>ادخل اسم اللون الجديد بالعربي</label><br>
                <input type="text" name="color" placeholder="اللون"><br>
                <button type="submit" name="addColor">إضافة</button>
            </form>
        </details>
        <h2 style="margin-top:50px;">قوائم المعلومات</h2>
        <details>
            <summary>قائمة السيارات المعروضة</summary>
            <table>
                <tr>
                    <th>البراند</th>
                    <th>الاسم</th>
                    <th>الموديل</th>
                    <th>الألوان</th>
                    <th>الممشى</th>
                    <th>القير</th>
                    <th>الفئة</th>
                    <th>الوقود</th>
                    <th>الفئة</th>
                    <th>السعر</th>
                    <th>على الصفحة الرئيسية؟</th>
                </tr>
                    <?php
                        $sql = "SELECT * FROM cars";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck > 0){
                            while ($row = $result->fetch_assoc()){
                                    echo '<tr>';
                                    echo '<td>'.$row['brand'].'</td>';
                                    echo '<td>'.$row['car_name'].'</td>';
                                    echo '<td>'.$row['model'].'</td>';
                                    echo '<td>'.$row['colors'].'</td>';
                                    echo '<td>'.$row['roadtrip'].'</td>';
                                    echo '<td>'.$row['gearbox'].'</td>';
                                    echo '<td>'.$row['tier'].'</td>';
                                    echo '<td>'.$row['petrol'].'</td>';
                                    echo '<td>'.$row['category'].'</td>';
                                    if ($row['price'] == 0){
                                        echo '<td>عند الاتصال</td>';
                                    }
                                    else{
                                        echo '<td>'.$row['price'].' ريال</td>';
                                    }
                                    if ($row['show_page'] == 0){
                                        echo '<td>لا</td>';
                                    }
                                    else {
                                        echo '<td>نعم</td>';
                                    }
                                    echo '<td><a href="carpage.php?id='.$row['id'].'"><button>ذهاب</button></a></td>';
                                    echo '<td><a href="admin.php?editCar='.$row['id'].'"><button>تعديل</button></a></td>';
                                    echo '<td><a href="handler.php?delete='.$row['id'].'"><button>حذف</button></a></td>';
                                    echo '</tr>';
                            }
                        }
                    ?>
            </table>
        </details>
        <details>
            <summary>قائمة معلومات التواصل</summary>
            <table>
                <tr>
                    <th>الاسم</th>
                    <th>رقم الجوال (بدون اول صفر)</th>
                </tr>
            <?php
                $sql = "SELECT * FROM contacts";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0){
                    while ($row = $result->fetch_assoc()){
                        echo '<tr>';
                        echo '<td>'.$row['contact_name'].'</td>';
                        echo '<td>'.$row['phone_number'].'</td>';
                        echo '<td><a href="admin.php?editContact='.$row['id'].'"><button>تعديل</button></a></td>';
                        echo '<td><a href="handler.php?deleteContact='.$row['id'].'"><button>حذف</button></a></td>';
                        echo '</tr>';
                    }
                }
            ?>
            </table>
        </details>
        <details>
            <summary>قائمة الألوان المتاحة</summary>
            <table>
                <tr>
                    <th>اللون</th>
                </tr>
                <?php
                    $sql = "SELECT * from colors";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0){
                        for ($c = 1; $c <= $resultCheck; $c++){
                            $row = $result->fetch_assoc();
                            echo '<tr>';
                            echo '<td>'.$row['color'].'</td>';
                            echo '<td><a href="handler.php?deleteColor='.$row['id'].'"><button>حذف</button></a></td>';
                            echo '</tr>';
                        }
                    }
                ?>
            </table>
        </details>
        
    </div>
</main>

<?php
    mysqli_close($conn);
    include 'footer.php';
?>