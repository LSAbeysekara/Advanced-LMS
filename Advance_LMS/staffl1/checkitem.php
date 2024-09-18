<?php

include('config/constant.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemcode = $_POST['itemcode'];
    $query = "SELECT COUNT(*) AS count FROM tb_producr WHERE item_code = '$itemcode'";
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
