<?php include('config/constant.php'); ?>

<?php
     $id = $_SESSION['id'];
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!empty($_POST['title']) && !empty($_POST['district']) && !empty($_POST['description']) && isset($_FILES['c_image'])) {
        
        $title = $_POST['title'];
        $district = $_POST['district'];
        $description = $_POST['description'];
        $link = $_POST['location'];


        $sql = "SELECT MAX(CAST(SUBSTRING(c_id, 4) AS UNSIGNED)) AS max_id FROM tb_courses WHERE c_id LIKE 'CID%'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $last_id_number = $row["max_id"];
            
            // Increment the last ACT... number
            $next_id_number = $last_id_number + 1;
            
            // Construct the next ACT... value
            $next_id = "CID" . $next_id_number;
            
        } else {
            $next_id = "CID1";
        }
            

        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');
        
        $image_na = basename($_FILES["c_image"]["name"]);
        $target_dir = "../student/rh/images/accomodation/";
        $target_file = $target_dir . basename($_FILES["c_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["c_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $_SESSION['add-acom-error-no'] = "Error";
            header('location:./acom_add.php');
            exit;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION['add-acom-error-dif'] = "Error";
            header('location:./acom_add.php');
            exit;
        }

        if ($uploadOk == 0) {
            $_SESSION['add-acom-error-no'] = "Error";
            header('location:./acom_add.php');
            exit;

        } else {
            if (move_uploaded_file($_FILES["c_image"]["tmp_name"], $target_file)) {

                if($link != ""){

                    $sql = "INSERT INTO tb_courses SET
                        c_id = '$next_id',
                        c_name = '$title',
                        c_type = 'acom',
                        t_id = '$id',
                        created = '$currentDateTime',
                        status = 'Pending',
                        description = '$description',
                        cou_img = '$image_na',
                        location = '$district',
                        l_link = '$link'
                    ";
                    $res = mysqli_query($conn, $sql);

                    if($res == true){

                        $_SESSION['add-acom-ok'] = "OK";
                        header('location:./acom_add.php');

                    }
                    else
                    {
                        $_SESSION['add-acom-error'] = "Error";
                        header('location:./acom_add.php');
                        
                    }

                }else{

                    $sql = "INSERT INTO tb_courses SET
                        c_id = '$cid',
                        c_name = '$title',
                        c_type = 'acom',
                        t_id = '$id',
                        created = '$currentDateTime',
                        status = 'Pending',
                        description = '$description',
                        cou_img = '$image_na',
                        location = '$district'
                    ";
                    $res = mysqli_query($conn, $sql);

                    if($res == true){

                        $_SESSION['add-acom-ok'] = "OK";
                        header("Location: ./acom_add.php");

                    }
                    else
                    {
                        $_SESSION['add-acom-error'] = "Error";
                        header('location:./acom_add.php');
                        
                    }
                }
                
                

            } else {
                $_SESSION['add-acom-error'] = "Error";
                header('location:./acom_add.php');
                exit;
            }
        }
    } else {
        $_SESSION['add-acom-error'] = "Error";
        header('location:./acom_add.php');
    }
} else {
    $_SESSION['add-acom-error'] = "Error";
    header('location:./acom_add.php');
}
?>
