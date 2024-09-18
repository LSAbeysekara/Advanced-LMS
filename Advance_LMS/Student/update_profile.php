<?php
include('config/constant.php');

if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $st_name = $_POST['name'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];

    if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == UPLOAD_ERR_OK) {
        
        $uploadDirectory = "./images/profile-pic/";

        $fileExtension = strtolower(pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION));

        $filename = $username . "_pro_pic." . $fileExtension;

        $targetPath = $uploadDirectory . $filename;

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetPath)) {

            $sql = "UPDATE `tb_student` SET `pro_img`='$filename', `st_name`='$st_name', `address`='$address', `mobile`='$mobile', `date_of_birth`='$dob' WHERE `username`='$username'";
            $res = mysqli_query($conn, $sql);

            if($res == true){

                $_SESSION['upload-profile-ok'] = "OK";
                header("Location: ./profile.php");
            }
            else
            {
                $_SESSION['upload-profilec-error'] = "error";
                header("Location: ./edit_profile.php");            
            }

        } else {

            

            $_SESSION['upload-profile-error'] = "error";
            header("Location: ./edit_profile.php");
        }
    } else {

        $sql = "UPDATE `tb_student` SET `st_name`='$st_name', `address`='$address', `mobile`='$mobile', `date_of_birth`='$dob' WHERE `username`='$username'";
        $res = mysqli_query($conn, $sql);

        if($res == true){

            $_SESSION['upload-profile-ok'] = "OK";
            header("Location: ./profile.php");
        }
        else
        {
            $_SESSION['upload-profilec-error'] = "error";
            header("Location: ./edit_profile.php");            
        }
        $_SESSION['upload-profile-error'] = "error";
        header("Location: ./edit_profile.php");
    }
} else {
    header("Location: profile_pic_upload.php");
    exit;
}
?>