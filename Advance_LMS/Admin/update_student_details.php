<?php
include('config/constant.php');
session_start();
if(isset($_POST['username'])){

    $name = $_POST["name"];
    $nic = $_POST["nic"];
    $mobile = $_POST["mobile"];
    $dob = $_POST["dob"];
    $address = $_POST["address"];
    $username = $_POST["username"];
    $active = "Active";

    $sql = "UPDATE `tb_student` SET `st_name`='$name', `address`='$address', `mobile`='$mobile', `date_of_birth`='$dob', `nic`='$nic', `status`='$active' WHERE `username`='$username'";
    $res = mysqli_query($conn, $sql);

    if($res == true){

        $_SESSION['add-details-ok'] = "OK";
        $_SESSION['student_name'] = $name;
        $_SESSION['status'] = $active;
        header("Location: ./liststudent.php");

    }
    else
    {
        $_SESSION['add-details-error'] = "error";
        header("Location: ./liststudent.php");
        
    }

}else{
    $_SESSION['add-details-error'] = "error";
    header("Location: ./liststudent.php");
}

?>