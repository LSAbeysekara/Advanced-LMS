<?php
session_start();
include('config/constant.php');

    if(isset($_POST['submit'])){
        $c_id = $_POST['course_id'];
        $s_id = $_POST['student_id'];
        $create=$_SESSION['admin_name'];

        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');

                
        $sql2 = "INSERT INTO tb_enrollment SET
            course_id = '$c_id',
            st_id = '$s_id',
            enroll_date = '$currentDateTime',
            created_by = '$create'
        ";
        $res2 = mysqli_query($conn, $sql2);


        if($res2 == true){

            $_SESSION['add-error'] = "success";
            echo "<script> window.location.replace('enrolledstudent.php?id=".$c_id."'); </script>";
        }
        else
        {
           // echo "Failed";
            //failed to insert data
             $_SESSION['add-error'] = "error";
             echo "<script> window.location.replace('enrolledstudent.php?id=".$c_id."'); </script>";
            
        }
        //redirect with message to manage food page
    }else{

        echo "Not submitted";
        
    //     $_SESSION['add-error'] = "error";
    echo "<script> window.location.replace('enrolledstudent.php?id=".$c_id."'); </script>";
    
    }
?>
