<?php
    require_once 'dbh.inc.php';
    require_once 'functions.php';
    
    if (isset($_POST["login"])){
        $name = mysqli_real_escape_string($conn,$_POST["username"]);
        $passwrd = mysqli_real_escape_string($conn,$_POST["passwrd"]);
        loginUser($conn, $name, $passwrd);
    }

    else if (isset($_POST["register"])){
        $name = mysqli_real_escape_string($conn, $_POST["username"]);
        $passwrd = mysqli_real_escape_string($conn, $_POST["passwrd"]);
        $passwrd2 = mysqli_real_escape_string($conn, $_POST["passwrd2"]);
        if (invalidName($name) !== false){
            header("location: ../project/signup.php?error=invalidname");
            exit();
        }

        else if (invalidPasswrd($passwrd, $passwrd2) !== false){
            header("location: ../project/signup.php?error=passwordnotsame");
            exit();
        }

        else if (userExists($conn, $name) !== false){
            header("location: ../project/signup.php?error=nametaken");
            exit();
        }

        createUser($conn, $name, $passwrd);
        header("location: ../project/signup.php?error=none");
        exit();
    }
    

    else if (isset($_POST["addCar"])){
        $id = mysqli_real_escape_string($conn, $_POST["id"]);
        $brand = mysqli_real_escape_string($conn, $_POST["brand"]);
        $car_name = mysqli_real_escape_string($conn, $_POST["car_name"]);
        $model = mysqli_real_escape_string($conn, $_POST["model"]);
        //$color = mysqli_real_escape_string($conn, $_POST["color"]);
        $roadtrip = mysqli_real_escape_string($conn, $_POST["roadtrip"]);
        $gearbox = mysqli_real_escape_string($conn, $_POST["gearbox"]);
        $tier = mysqli_real_escape_string($conn, $_POST["tier"]);
        $petrol = mysqli_real_escape_string($conn, $_POST["petrol"]);
        $category = mysqli_real_escape_string($conn, $_POST["category"]);
        $carinfo = mysqli_real_escape_string($conn, $_POST["car_info"]);
        $price = mysqli_real_escape_string($conn, $_POST["price"]);
        $show_page = mysqli_real_escape_string($conn, $_POST["showPage"]);
        $uploadLocation = 'gfx/cars/';
        if (strlen($_FILES["img1"]["name"]) != 0){
            $img1 = date("h-i-sa").$_FILES["img1"]["name"];
            $img1Temp = $_FILES["img1"]["tmp_name"];
            move_uploaded_file($_FILES["img1"]["tmp_name"], $uploadLocation.$img1);
        }
        if (strlen($_FILES["img2"]["name"]) != 0){
            $img2 = date("h-i-sa").$_FILES["img2"]["name"];
            $img2Temp = $_FILES["img2"]["tmp_name"];
            move_uploaded_file($_FILES["img2"]["tmp_name"], $uploadLocation.$img2);
        }
        if (strlen($_FILES["img3"]["name"]) != 0){
            $img3 = date("h-i-sa").$_FILES["img3"]["name"];
            $img3Temp = $_FILES["img3"]["tmp_name"];
            move_uploaded_file($_FILES["img3"]["tmp_name"], $uploadLocation.$img3);
        }
        if (strlen($_FILES["img4"]["name"]) != 0){
            $img4 = date("h-i-sa").$_FILES["img4"]["name"];
            $img4Temp = $_FILES["img4"]["tmp_name"];
            move_uploaded_file($_FILES["img4"]["tmp_name"], $uploadLocation.$img4);
        }
        if (strlen($_FILES["img5"]["name"]) != 0){
            $img5 = date("h-i-sa").$_FILES["img5"]["name"];
            $img5Temp = $_FILES["img5"]["tmp_name"];
            move_uploaded_file($_FILES["img5"]["tmp_name"], $uploadLocation.$img5);
        }
        if (strlen($_FILES["img6"]["name"]) != 0){
            $img6 = date("h-i-sa").$_FILES["img6"]["name"];
            $img6Temp = $_FILES["img6"]["tmp_name"];
            move_uploaded_file($_FILES["img6"]["tmp_name"], $uploadLocation.$img6);
        }
        if (strlen($_FILES["img7"]["name"]) != 0){
            $img7 = date("h-i-sa").$_FILES["img7"]["name"];
            $img7Temp = $_FILES["img7"]["tmp_name"];
            move_uploaded_file($_FILES["img7"]["tmp_name"], $uploadLocation.$img7);
        }
        if (strlen($_FILES["img8"]["name"]) != 0){
            $img8 = date("h-i-sa").$_FILES["img8"]["name"];
            $img8Temp = $_FILES["img8"]["tmp_name"];
            move_uploaded_file($_FILES["img8"]["tmp_name"], $uploadLocation.$img8);
        }    
        $colorSelected = array();
        $sql = "SELECT * FROM colors";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        for ($t = 0; $t < $resultCheck; $t++){
            if (isset($_POST['color'.$t])){
                array_push($colorSelected, $_POST['color'.$t]);
            }
        }
        $colorSelectedString = '';
        for ($p = 0; $p < count($colorSelected); $p++){
            if ($p == count($colorSelected)-1){
                $colorSelectedString = $colorSelectedString.$colorSelected[$p];
            }
            else {
                $colorSelectedString = $colorSelectedString.$colorSelected[$p].' - ';
            }
        }

        addCar($conn, $brand, $car_name, $model, $colorSelectedString, $roadtrip, $gearbox, $tier, $petrol, $category, $carinfo, $price, $img1, $img2, $img3, $img4, $img5, $img6, $img7, $img8, $show_page);
    }

    else if (isset($_GET['delete'])){
        $id = mysqli_real_escape_string($conn, $_GET['delete']);
        removeCar($conn, $id);
    }

    else if (isset($_POST['editCar'])){
        $id = mysqli_real_escape_string($conn, $_POST["id"]);
        $brand = mysqli_real_escape_string($conn, $_POST["brand"]);
        $car_name = mysqli_real_escape_string($conn, $_POST["car_name"]);
        $model = mysqli_real_escape_string($conn, $_POST["model"]);
        //$color = mysqli_real_escape_string($conn, $_POST["color"]);
        $roadtrip = mysqli_real_escape_string($conn, $_POST["roadtrip"]);
        $gearbox = mysqli_real_escape_string($conn, $_POST["gearbox"]);
        $tier = mysqli_real_escape_string($conn, $_POST["tier"]);
        $petrol = mysqli_real_escape_string($conn, $_POST["petrol"]);
        $category = mysqli_real_escape_string($conn, $_POST["category"]);
        $carinfo = mysqli_real_escape_string($conn, $_POST["car_info"]);
        $price = mysqli_real_escape_string($conn, $_POST["price"]);
        $show_page = mysqli_real_escape_string($conn, $_POST["showPage"]);
        $uploadLocation = 'gfx/cars/';
        if (isset($_FILES["img1"]["name"])){
            $img1 = date("h-i-sa").$_FILES["img1"]["name"];
            $img1Temp = $_FILES["img1"]["tmp_name"];
            move_uploaded_file($_FILES["img1"]["tmp_name"], $uploadLocation.$img1);
        }
        if (isset($_FILES["img2"]["name"])){
            $img2 = date("h-i-sa").$_FILES["img2"]["name"];
            $img2Temp = $_FILES["img2"]["tmp_name"];
            move_uploaded_file($_FILES["img2"]["tmp_name"], $uploadLocation.$img2);
        }
        if (isset($_FILES["img3"]["name"])){
            $img3 = date("h-i-sa").$_FILES["img3"]["name"];
            $img3Temp = $_FILES["img3"]["tmp_name"];
            move_uploaded_file($_FILES["img3"]["tmp_name"], $uploadLocation.$img3);
        }
        if (isset($_FILES["img4"]["name"])){
            $img4 = date("h-i-sa").$_FILES["img4"]["name"];
            $img4Temp = $_FILES["img4"]["tmp_name"];
            move_uploaded_file($_FILES["img4"]["tmp_name"], $uploadLocation.$img4);
        }
        if (isset($_FILES["img5"]["name"])){
            $img5 = date("h-i-sa").$_FILES["img5"]["name"];
            $img5Temp = $_FILES["img5"]["tmp_name"];
            move_uploaded_file($_FILES["img5"]["tmp_name"], $uploadLocation.$img5);
        }
        if (isset($_FILES["img6"]["name"])){
            $img6 = date("h-i-sa").$_FILES["img6"]["name"];
            $img6Temp = $_FILES["img6"]["tmp_name"];
            move_uploaded_file($_FILES["img6"]["tmp_name"], $uploadLocation.$img6);
        }
        if (isset($_FILES["img7"]["name"])){
            $img7 = date("h-i-sa").$_FILES["img7"]["name"];
            $img7Temp = $_FILES["img7"]["tmp_name"];
            move_uploaded_file($_FILES["img7"]["tmp_name"], $uploadLocation.$img7);
        }
        if (isset($_FILES["img8"]["name"])){
            $img8 = date("h-i-sa").$_FILES["img8"]["name"];
            $img8Temp = $_FILES["img8"]["tmp_name"];
            move_uploaded_file($_FILES["img8"]["tmp_name"], $uploadLocation.$img8);
        }

        $editColorSelected = array();
        $sql = "SELECT * FROM colors";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        for ($t = 0; $t < $resultCheck; $t++){
            if (isset($_POST['color'.$t])){
                array_push($editColorSelected, $_POST['color'.$t]);
            }
        }
        $colorSelectedString = '';
        for ($p = 0; $p < count($editColorSelected); $p++){
            if ($p == count($editColorSelected)-1){
                $colorSelectedString = $colorSelectedString.$editColorSelected[$p];
            }
            else {
                $colorSelectedString = $colorSelectedString.$editColorSelected[$p].' - ';
            }
        }

        editCar($conn, $id, $brand, $car_name, $model, $colorSelectedString, $roadtrip, $gearbox, $tier, $petrol, $category, $carinfo, $price, $img1, $img2, $img3, $img4, $img5, $img6, $img7, $img8, $show_page);
        
    }

    else if(isset($_POST['addContact'])){
        $contact_name = mysqli_real_escape_string($conn, $_POST['contactName']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        addContact($conn, $contact_name, $phone_number);
    }
    
    else if (isset($_POST['editContact'])){
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $contact_name = mysqli_real_escape_string($conn, $_POST['contactName']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
        editContact($conn, $id, $contact_name, $phone_number);
    }

    else if (isset($_GET['deleteContact'])){ 
        $id = mysqli_real_escape_string($conn, $_GET['deleteContact']);
        removeContact($conn, $id);
    }

    else if(isset($_POST['addColor'])){
        $color = mysqli_real_escape_string($conn, $_POST['color']);
        addColor($conn, $color);
    }

    else if(isset($_GET['deleteColor'])){
        $id = mysqli_real_escape_string($conn ,$_GET['deleteColor']);
        deleteColor($conn, $id);
    }
?>