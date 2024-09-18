<?php
session_start();
include('config/constant.php');

    if(isset($_POST['submit'])){
        $c_id = $_POST['course_id'];
        $c_name = $_POST['course_name'];
        $t_id = $_POST['teacher_id'];
        $status = $_POST['status'];
        $c_type = "lms";

        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');

                
        $sql2 = "INSERT INTO tb_courses SET
            c_id = '$c_id',
            c_name = '$c_name',
            t_id = '$t_id',
            c_type = '$c_type',
            created = '$currentDateTime',
            status = '$status'
        ";
        $res2 = mysqli_query($conn, $sql2);


        if($res2 == true){

            $_SESSION['add-error'] = "success";
            header('location: create_course.php');
        }
        else
        {
           // echo "Failed";
            //failed to insert data
             $_SESSION['add-error'] = "error";
             header('location: create_course.php');
            
        }
        //redirect with message to manage food page
    }else{

        echo "Not submitted";
        
    //     $_SESSION['add-error'] = "error";
         header('location: course-create.php');
    
    }
?>
