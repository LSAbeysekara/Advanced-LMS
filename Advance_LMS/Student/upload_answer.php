<?php
include('config/constant.php');

    if(isset($_POST['submit'])){
        
        $act_id = $_POST['act_id'];
        $act_name = $_POST['act_name'];
        $username = $_POST['username'];
        $c_id = $_POST['c_id'];

        //Take current date and time
        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');


        //Checking file upload
        if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $originalFileName = $_FILES['file']['name'];
            $tempFilePath = $_FILES['file']['tmp_name'];

            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        
    
            $newFileName = $act_id . '-' . $username . '.' . $fileExtension;
    
            $uploadPath = '../Teacher/assignment/'.$c_id."_".$act_name."/";
    
            if (move_uploaded_file($tempFilePath, $uploadPath . $newFileName)) {
                
            } else {
                $_SESSION['answer-add-error'] = "error";
                header("Location: ./assignment_view.php?act_id=$act_id&c_id=$c_id");
            }
        } else {
            echo "Error: " . $_FILES['file']['error'];
        }
        

        if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $file_type = $_FILES['file']['type'];
        }else{
            $_SESSION['answer-add-error'] = "error";
            header("Location: ./assignment_view.php?act_id=$act_id&c_id=$c_id");

        }


        $sql3 = "SELECT * FROM tb_submission WHERE act_id = '$act_id' AND st_username = '$username'";

        $res3 = mysqli_query($conn, $sql3);

        $count3 = mysqli_num_rows($res3);

        if($count3>0)
        {
            $sql4 = "UPDATE `tb_submission` SET `uploaded_date`='$currentDateTime', `file_name`='$newFileName',`file_type`='$file_type' WHERE act_id = '$act_id' AND st_username = '$username'";
            $res4 = mysqli_query($conn, $sql4);

            if($res2 == true){

                $_SESSION['answer-add-ok'] = "OK";
                header("Location: ./assignment_view.php?act_id=$act_id&c_id=$c_id");

            }
            else
            {
                $_SESSION['answer-add-error'] = "error";
                header("Location: ./assignment_view.php?act_id=$act_id&c_id=$c_id");
                
            }

        }else{

            $sql2 = "INSERT INTO tb_submission SET
                act_id = '$act_id',
                file_name = '$newFileName',
                file_type = '$file_type',
                st_username = '$username',
                uploaded_date = '$currentDateTime'
            ";
            $res2 = mysqli_query($conn, $sql2);


            if($res2 == true){

                $_SESSION['answer-add-ok'] = "OK";
                header("Location: ./assignment_view.php?act_id=$act_id&c_id=$c_id");

            }
            else
            {
                $_SESSION['answer-add-error'] = "error";
                header("Location: ./assignment_view.php?act_id=$act_id&c_id=$c_id");
                
            }
        }

    }else{
        
        $_SESSION['answer-add-error'] = "error";
        header("Location: ./assignment_view.php?act_id=$act_id&c_id=$c_id");
    
    }
?>



