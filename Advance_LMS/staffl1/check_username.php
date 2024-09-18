<?php

include('config/constant.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = "AD_".$_POST['username'];
    $query = "SELECT COUNT(*) AS count FROM tb_adminstration WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count > 0) {
            echo 'exist';
        } else {
            echo 'available';
        }
    } else {
        echo 'error';
    }
}
?>
