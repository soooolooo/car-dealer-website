<?php
    include 'head.php';
    include 'header.php';
    include 'dbh.inc.php';
?>

<main style="text-align: center;" dir="rtl">

    <form action="test.php" method="POST">
        <?php
            $sql = "SELECT * FROM colors";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                for ($u = 0; $u < $resultCheck; $u++){
                    $row = $result->fetch_assoc();
                    echo '
                        <label>'.$row['color'].'</label>
                        <input type="checkbox" name="color'.$u.'" value="'.$row['color'].'">
                    ';

                    if (($u % 2) == 0){
                        echo '<br>';
                    }
                }
            }
        ?>
        <br><button type="submit" name="colorSubmit">submit</button>
    </form>

    <?php
        if (isset($_POST['colorSubmit'])){
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
            echo $colorSelectedString;
        }
    ?>

</main>

<?php
    mysqli_close($conn);
    include 'footer.php';
?>