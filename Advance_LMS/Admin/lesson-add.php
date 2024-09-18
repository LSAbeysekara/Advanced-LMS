<?php
include('config/constant.php');

    if(isset($_POST['submit'])){
        $les_name = $_POST['lesson_name'];
        $t_id = $_POST['t_id'];
        $status = $_POST['status'];
        $c_id = $_POST['c_id'];
        //Creating ID
        $sql = "SELECT les_id FROM tb_lesson ORDER BY les_id DESC LIMIT 1";

        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastData = $row['les_id'];
        
        } else {
            $lastData = "LES0";
        }


        $string = $lastData;
        preg_match_all('/\d+/', $string, $matches);
        $number = implode('', $matches[0]);
        $number++;
        $les = "LES";
        $les_id = $les.$number;

        //Take current date and time
        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');


        //Checking file upload
        if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $originalFileName = $_FILES['file']['name'];
            $tempFilePath = $_FILES['file']['tmp_name'];

            $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        
    
            $newFileName = time() . '.' . $fileExtension;
    
            // Specify the directory where you want to store the uploaded files
            $uploadPath = './lessons/';
    
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($tempFilePath, $uploadPath . $newFileName)) {
                
                echo "File uploaded successfully!";
            } else {
                echo "Error uploading file.";
            }
        } else {
            echo "Error: " . $_FILES['file']['error'];
        }
        

        //Take file type
        if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            // Get the file type
            $file_type = $_FILES['file']['type'];
        }else{
            header("Location: ./add-lesson.php");

        }

                
        $sql2 = "INSERT INTO tb_lesson SET
            les_id = '$les_id',
            les_name = '$les_name',
            file = '$newFileName',
            file_type = '$file_type',
            created_date = '$currentDateTime',
            t_id = '$t_id',
            c_id = '$c_id',
            status = '$status'
        ";
        $res2 = mysqli_query($conn, $sql2);


        if($res2 == true){

            echo "Added";

        }
        else
        {
            echo "Failed";
            //failed to insert data
            // $_SESSION['add-error'] = "error";
            // header('location: admin.php');
            
        }
        //redirect with message to manage food page
    }else{

        echo "Not submitted";
        
    //     $_SESSION['add-error'] = "error";
    //     header('location: admin.php');
    
    }
?>



