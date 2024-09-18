<?php
include('config/constant.php');

    if(isset($_POST['submit'])){
        $les_name = $_POST['lesson_name'];
        $c_id = $_POST['c_id'];
        $t_id = $_POST['t_id'];
        $status = $_POST['status'];


        $sql = "SELECT MAX(CAST(SUBSTRING(les_id, 4) AS UNSIGNED)) AS max_id FROM tb_lesson WHERE les_id LIKE 'LES%'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $last_id_number = $row["max_id"];
            
            $next_id_number = $last_id_number + 1;
            
            $next_id = "LES" . $next_id_number;
            
        } else {
            $next_id = "LES1";
        }

        
        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');


        if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $originalFileName = $_FILES['file']['name'];
            $tempFilePath = $_FILES['file']['tmp_name'];

            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        
    
            $newFileName = time() . '.' . $fileExtension;
    
            $uploadPath = './lessons/';
    
            if (move_uploaded_file($tempFilePath, $uploadPath . $newFileName)) {
                
                echo "File uploaded successfully!";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Error: " . $_FILES['file']['error'];
        }
        

        if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {

            $file_type = $_FILES['file']['type'];
        }else{
            echo "<script> window.location.replace('course.php?id=".$c_id."'); </script>";
        }

                
        $sql2 = "INSERT INTO tb_lesson SET
            les_id = '$next_id',
            les_name = '$les_name',
            c_id = '$c_id',
            file = '$newFileName',
            file_type = '$file_type',
            created_date = '$currentDateTime',
            t_id = '$t_id',
            status = '$status'
        ";
        $res2 = mysqli_query($conn, $sql2);


        if($res2 == true){
            $_SESSION['add-success'] = "success";
            echo "<script> window.location.replace('course.php?id=".$c_id."'); </script>";
        }
        else
        {
            $_SESSION['add-error'] = "error";
            echo "<script> window.location.replace('course.php?id=".$c_id."'); </script>";
        }
        
    }else{
        $_SESSION['add-error'] = "error";
        echo "<script> window.location.replace('course.php?id=".$c_id."'); </script>";
    }
?>



