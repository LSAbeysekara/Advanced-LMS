<?php include('../config/constant.php'); ?>

<?php
    $id = "6";
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!empty($_POST['title']) && !empty($_POST['district']) && !empty($_POST['description']) && isset($_FILES['c_image'])) {
        
        $title = $_POST['title'];
        $district = $_POST['district'];
        $description = $_POST['description'];
        $link = $_POST['location'];

        
        $sql3 = "SELECT c_id FROM tb_courses ORDER BY c_id DESC LIMIT 1";

        $result = $conn->query($sql3);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastData = $row['c_id'];
        
        } else {
            $lastData = "CID0";
        }

        $string = $lastData;
        preg_match_all('/\d+/', $string, $matches);
        $number = implode('', $matches[0]);
        
        $cid = "CID". ++$number; 
            

        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');
        
        $image_na = basename($_FILES["c_image"]["name"]);
        $target_dir = "./images/";
        $target_file = $target_dir . basename($_FILES["c_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["c_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $_SESSION['add-act-error'] = "Error";
           // header('location:./ex_add.php');
            exit;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION['add-act-error-dif'] = "Error";
            header('location:./ex_add.php');
            exit;
        }

        if ($uploadOk == 0) {
            $_SESSION['add-act-error-no-file'] = "Error";
            header('location:./ex_add.php');
            exit;

        } else {
            if (move_uploaded_file($_FILES["c_image"]["tmp_name"], $target_file)) {

                if($link != ""){

                    $sql = "INSERT INTO tb_courses SET
                        c_id = '$cid',
                        c_name = '$title',
                        c_type = 'extra',
                        t_id = '$id',
                        created = '$currentDateTime',
                        status = 'pending',
                        description = '$description',
                        cou_img = '$image_na',
                        location = '$district',
                        l_link = '$link'
                    ";
                    $res = mysqli_query($conn, $sql);

                    if($res == true){

                        $_SESSION['add-act-ok'] = "OK";
                        header('location:./ex_add.php');

                    }
                    else
                    {
                        $_SESSION['add-act-error'] = "Error";
                        header('location:./ex_add.php');
                        
                    }

                }else{

                    $sql = "INSERT INTO tb_courses SET
                        c_id = '$cid',
                        c_name = '$title',
                        c_type = 'extra',
                        t_id = '$id',
                        created = '$currentDateTime',
                        status = 'pending',
                        description = '$description',
                        cou_img = '$image_na',
                        location = '$district'
                    ";
                    $res = mysqli_query($conn, $sql);

                    if($res == true){

                        $_SESSION['add-act-ok'] = "OK";
                        header("Location: ./ex_add.php");

                    }
                    else
                    {
                        $_SESSION['add-act-error'] = "Error";
                        header('location:./ex_add.php');
                        
                    }
                }
                
                

            } else {
                $_SESSION['add-act-error'] = "Error";
                header('location:./ex_add.php');
                exit;
            }
        }
    } else {
        $_SESSION['add-act-error'] = "Error";
        header('location:./ex_add.php');
    }
} else {
    $_SESSION['add-act-error'] = "Error";
    header('location:./ex_add.php');
}
?>
