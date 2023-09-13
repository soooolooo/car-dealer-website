<?php
    function invalidName($name){
        $result;
        if (!preg_match("/^[a-zA-Z0-9]/", $name)){
            $result = true;
        }

        else{
            $result = false;
        }

        return $result;
    }

    function invalidPasswrd($passwrd, $passwrd2){
        $result;
        if ($passwrd !== $passwrd2){
            $result = true;
        }

        else{
            $result = false;
        }

        return $result;
    }

    function userExists($conn, $name){
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("locaton: ../project/signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        
        if ($row = $resultData->fetch_assoc()){
            return $row;
        }

        else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $name, $passwrd){
        $sql = "INSERT INTO users (username, passwrd)
                VALUES (?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("locaton: ../project/signup.php?error=stmtfailed");
            exit();
        }

        $hashedpasswrd = password_hash($passwrd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ss", $name, $hashedpasswrd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: success.php");
        exit();
    }
    
    function loginUser($conn, $username, $passwrd){
        $idExists = userExists($conn, $username);

        if (!$idExists){
            header("location: login.php?error=wronglogin");
            exit();
        }

        $passwordHashed = $idExists["passwrd"];
        $checkpasswrd = password_verify($passwrd, $passwordHashed);

        if (!$checkpasswrd){
            header("location: login.php?error=wronglogin");
            exit();
        }

        else if ($checkpasswrd){
            session_start();
            // $_SESSION["name"] = $idExists["username"];
            $_SESSION["username"] = $idExists["username"];
            header("location: index.php");
            exit();
        }
    }

    function addCar($conn, $brand, $car_name, $model, $colors, $roadtrip, $gearbox, $tier, $petrol, $category, $carinfo, $price, $img1, $img2, $img3, $img4, $img5, $img6, $img7, $img8, $show_page){
        $sql = "INSERT INTO cars (brand, car_name, model, colors, roadtrip, gearbox, tier, petrol, category, car_info, price, show_page) VALUES ('$brand', '$car_name', '$model', '$colors','$roadtrip', '$gearbox', '$tier', '$petrol', '$category', '$carinfo', '$price', '$show_page')";
        mysqli_query($conn, $sql);
        if (strlen($img1) != 0){
            $sql = "UPDATE cars SET img1 = '$img1' WHERE car_name = '$car_name'";
            mysqli_query($conn, $sql);
        }
        if (strlen($img2) != 0){
            $sql = "UPDATE cars SET img2 = '$img2' WHERE car_name = '$car_name'";
            mysqli_query($conn, $sql);
        }
        if (strlen($img3) != 0){
            $sql = "UPDATE cars SET img3 = '$img3' WHERE car_name = '$car_name'";
            mysqli_query($conn, $sql);
        }
        if (strlen($img4) != 0){
            $sql = "UPDATE cars SET img4 = '$img4' WHERE car_name = '$car_name'";
            mysqli_query($conn, $sql);
        }
        if (strlen($img5) != 0){
            $sql = "UPDATE cars SET img5 = '$img5' WHERE car_name = '$car_name'";
            mysqli_query($conn, $sql);
        }
        if (strlen($img6) != 0){
            $sql = "UPDATE cars SET img6 = '$img6' WHERE car_name = '$car_name'";
            mysqli_query($conn, $sql);
        }
        if (strlen($img7) != 0){
            $sql = "UPDATE cars SET img7 = '$img7' WHERE car_name = '$car_name'";
            mysqli_query($conn, $sql);
        }
        if (strlen($img8) != 0){
            $sql = "UPDATE cars SET img8 = '$img8' WHERE car_name = '$car_name'";
            mysqli_query($conn, $sql);
        }
        mysqli_close($conn);
        header('location: admin.php?success');
        exit();
    }

    function removeCar($conn, $id){
        $sql = "DELETE FROM cars WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
          } else {
            echo "Error deleting record: " . $conn->error;
          }
        mysqli_close($conn);
        header('location: admin.php?success');
        exit();
    }

    function editCar($conn, $id, $brand, $car_name, $model, $colors, $roadtrip, $gearbox, $tier, $petrol, $category, $carinfo, $price, $img1, $img2, $img3, $img4, $img5, $img6, $img7, $img8, $show_page){
        $sql = "UPDATE cars SET brand = '$brand', car_name = '$car_name', model = '$model', colors = '$colors', roadtrip = '$roadtrip', gearbox = '$gearbox', tier = '$tier', petrol = '$petrol', category = '$category', car_info = '$car_info', price = '$price', show_page = '$show_page' WHERE id = '$id'";
        mysqli_query($conn, $sql);
        if (isset($img1)){
            $sql = "UPDATE cars SET img1 = '$img1' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        }
        if (isset($img2)){
            $sql = "UPDATE cars SET img2 = '$img2' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        }
        if (isset($img3)){
            $sql = "UPDATE cars SET img3 = '$img3' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        }
        if (isset($img4)){
            $sql = "UPDATE cars SET img4 = '$img4' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        }
        if (isset($img5)){
            $sql = "UPDATE cars SET img5 = '$img5' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        }
        if (isset($img6)){
            $sql = "UPDATE cars SET img6 = '$img6' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        }
        if (isset($img7)){
            $sql = "UPDATE cars SET img7 = '$img7' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        }
        if (isset($img8)){
            $sql = "UPDATE cars SET img8 = '$img8' WHERE id = '$id'";
            mysqli_query($conn, $sql);
        }
        mysqli_close($conn);
        header('location: admin.php?success');
        exit();
    }

    function addContact($conn, $contact_name, $phone_number){
        $sql = "INSERT INTO contacts (contact_name, phone_number) VALUES ('$contact_name', '$phone_number')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header('location: admin.php?success');
        exit();
    }
    
    function editContact($conn, $id, $contact_name, $phone_number){
        $sql = "UPDATE contacts SET contact_name = '$contact_name', phone_number = '$phone_number' WHERE id = '$id'";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header('location: admin.php?success');
        exit();
    }

    function removeContact($conn, $id){
        $sql = "DELETE FROM contacts WHERE id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header('location: admin.php?success');
        exit();
    }

    function addColor($conn, $color){
        $sql = "INSERT INTO colors (color) VALUES ('$color')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header('location: admin.php?success');
        exit();
    }

    function deleteColor($conn, $id){
        $sql = "DELETE FROM colors WHERE id = $id";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        header('location: admin.php?success');
        exit();
    }
?>