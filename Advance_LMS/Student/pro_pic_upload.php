<?php
include('config/constant.php');

if(isset($_POST['submit'])){

    $username = $_POST['username'];

    if (isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == UPLOAD_ERR_OK) {
        
        $uploadDirectory = "./images/profile-pic/";

        $fileExtension = strtolower(pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION));

        $filename = $username . "_pro_pic." . $fileExtension;

        $targetPath = $uploadDirectory . $filename;

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetPath)) {

            $sql = "UPDATE `tb_student` SET `pro_img`='$filename' WHERE `username`='$username'";
            $res = mysqli_query($conn, $sql);

            if($res == true){

                $_SESSION['add-pic-ok'] = "OK";
                header("Location: ./index.php");
            }
            else
            {
                $_SESSION['add-pic-error'] = "error";
                header("Location: ./profile_pic_upload.php");            
            }

        } else {

            $_SESSION['add-pic-error'] = "error";
            header("Location: ./profile_pic_upload.php");
        }
    } else {
        $_SESSION['add-pic-error'] = "error";
        header("Location: ./profile_pic_upload.php");
    }
} else {
    header("Location: profile_pic_upload.php");
    exit;
}
?>