<?php include('config/constant.php'); 

if($_POST['username']){

    $username = $_POST['username'];
    $sql = "UPDATE `tb_student` SET `seller`='Active' WHERE `username`='$username'";


    if ($conn->query($sql) === TRUE) {
        $_SESSION['item-add-ok'] = "Added";
        header("Location: ./index.php");

    } else {
    $_SESSION['item-add-error'] = "error";
    header("Location: ./seller_dash.php");

    }}











?>