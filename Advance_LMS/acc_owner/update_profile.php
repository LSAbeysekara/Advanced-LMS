<?php
include('config/constant.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    $password=sha1($password);
    // Check if file is uploaded
    if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $target_dir = "./images/profile-pic/";
        $fileExtension = strtolower(pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION));
        $image_name = $username . "." . $fileExtension;
        $target_file = $target_dir . $image_name;

        if($password == ""){
            $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
            if ($check !== false) {

                // Upload image
                if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                    // Image uploaded successfully, now insert data into database
                    $sql = "UPDATE `tb_customer` SET cus_name='$name', email='$email', mobile='$mobile', address='$address', zip='$zip', pro_img='$image_name' WHERE username='$username'";
                    if (mysqli_query($conn, $sql)) {
                        
                        $_SESSION['upload-profile-ok'] = "OK";
                        header("Location: ./cus_profile.php");
                    
                    } else {
                        $_SESSION['upload-profile-error'] = "Error";
                        header("Location: ./cus_profile.php");
                    }
                } else {
                    $_SESSION['upload-profile-error'] = "Error";
                    header("Location: ./cus_profile.php");
                }
            } else {
                $_SESSION['upload-profile-error'] = "Error";
                header("Location: ./cus_profile.php");
            }

        }else{
        
            $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
            if ($check !== false) {

                // Upload image
                if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                    // Image uploaded successfully, now insert data into database
                    $sql = "UPDATE `tb_customer` SET cus_name='$name', email='$email', password='$password', mobile='$mobile', address='$address', zip='$zip', pro_img='$image_name' WHERE username='$username'";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['upload-profile-ok'] = "OK";
                        header("Location: ./cus_profile.php");
                    
                    } else {
                        $_SESSION['upload-profile-error'] = "Error";
                        header("Location: ./cus_profile.php");
                    }
                } else {
                    $_SESSION['upload-profile-error'] = "Error";
                    header("Location: ./cus_profile.php");
                }
            } else {
                $_SESSION['upload-profile-error'] = "Error";
                header("Location: ./cus_profile.php");
            }
        }
    } else {
        
        if($password == ""){
            
            $sql = "UPDATE `tb_customer` SET cus_name='$name', email='$email', mobile='$mobile', address='$address', zip='$zip' WHERE username='$username'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['upload-profile-ok'] = "OK";
                header("Location: ./cus_profile.php");
            } else {
                $_SESSION['upload-profile-error'] = "Error";
                header("Location: ./cus_profile.php");
            }
                

        }else{
        
            $sql = "UPDATE `tb_customer` SET cus_name='$name', email='$email', password='$password', mobile='$mobile', address='$address', zip='$zip' WHERE username='$username'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['upload-profile-ok'] = "OK";
                header("Location: ./cus_profile.php");
            } else {
                $_SESSION['upload-profile-error'] = "Error";
                header("Location: ./cus_profile.php");
            }
        }
    }

    // Close connection
    mysqli_close($conn);
}
?>
