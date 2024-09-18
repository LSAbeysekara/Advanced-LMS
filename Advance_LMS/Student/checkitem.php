<?php
include('config/constant.php'); ?>

<?php

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
}else{ ?>

<?php $username = $_SESSION['username']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemcode = $_POST['itemcode'];
    $query = "SELECT COUNT(*) AS count FROM tb_product WHERE item_code = '$itemcode'";
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
}
?>
