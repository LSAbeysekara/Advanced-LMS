<?php
include('config/constant.php');

if (isset($_POST['submit'])) {
    $act_id = $_POST['act_id'];
    $assignment_name = $_POST['assignment_name'];
    $deadline = $_POST['deadline'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $old_file = $_POST['old_file'];
    $old_file_type = $_POST['old_file_type'];
    $c_id=$_POST['c_id'];

    if (isset($_FILES['file'])) {

        $file_name = $_FILES['file']['name'];

        if ($file_name != "") {

            $src_path = $_FILES['file']['tmp_name']; // source path
            $dest_path = "./activities/" . $file_name; // destination path

            $upload = move_uploaded_file($src_path, $dest_path);

            if (!$upload) {
                // failed to upload
                $_SESSION['update_file_error'] = "Failed To Upload The File.";
                echo "<script> window.location.replace('assignments.php?id=".$c_id."'); </script>";
    
                die();
            }

            if ($file != "") {
                
                $remove_path = "./activities/" . $old_file;
                $remove = unlink($remove_path);

                if (!$remove) {
                    // failed to remove current file
                    $_SESSION['update_assignment_error'] = "Failed To Remove The Current File.";
                    echo "<script> window.location.replace('assignments.php?id=".$c_id."'); </script>";
                        die();
                }
            }

            if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                // Get the file type
                $file_type = $_FILES['file']['type'];
            }else{
                echo "<script> window.location.replace('assignments.php?id=".$c_id."'); </script>";
    
            }

        } else {
            $file_name = $old_file;
            $file_type = $old_file_type;
        }
    } else {
        $file_name = $old_file;
        $file_type = $old_file_type;
    }

        $sql = "UPDATE tb_activity SET
            act_name = '$assignment_name',
            file_name = '$file_name',
            file_type = '$file_type',
            content = '$content',
            deadline = '$deadline',
            status = '$status'
            WHERE act_id='$act_id' 
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed or not
        
        if($res==true){

            $_SESSION['update_image-ok'] = "Success"; 
            echo "<script> window.location.replace('assignments.php?id=".$c_id."'); </script>";
    
        
        }
        else
        {
            //failed to update
            $_SESSION['update_image-error'] = "Error";
            echo "<script> window.location.replace('assignments.php?id=".$c_id."'); </script>";
    
        }

    }
?>