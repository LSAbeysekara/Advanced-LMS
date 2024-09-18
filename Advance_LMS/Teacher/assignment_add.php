<?php
include('config/constant.php');

    if(isset($_POST['submit'])){
        $act_name = $_POST['assignment_name'];
        $c_id = $_POST['c_id'];
        $content = $_POST['content'];
        $deadline = $_POST['deadline'];
        $status = $_POST['status'];

        //Creating ID
        $sql = "SELECT act_id FROM tb_activity ORDER BY act_id DESC LIMIT 1";

        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastData = $row['act_id'];
        
        } else {
            $lastData = "ACT0";
        }


        $string = $lastData;
        preg_match_all('/\d+/', $string, $matches);
        $number = implode('', $matches[0]);
        $number++;
        $act = "ACT";
        $act_id = $act.$number;

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
            $uploadPath = './activities/';
    
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

                
        $sql2 = "INSERT INTO tb_activity SET
            act_id = '$act_id',
            act_name = '$act_name',
            c_id = '$c_id',
            file_name = '$newFileName',
            file_type = '$file_type',
            content = '$content',
            act_type = 'assignment',
            deadline = '$deadline',
            created = '$currentDateTime',
            status = '$status'
        ";
        $res2 = mysqli_query($conn, $sql2);


        if($res2 == true){

            $directoryPath = './assignment/';

            // Specify the folder name
            $folderName = $c_id . '_' . $act_name;

            // Create the full path to the folder
            $fullPath = $directoryPath . $folderName;

            // Check if the folder already exists
            if (!is_dir($fullPath)) {
                // Attempt to create the folder
                if (mkdir($fullPath, 0777, true)) {
                    echo "Successfully created.";
                } else {
                    echo "Failed to create the folder.";
                }
            } else {
                echo "Folder '$folderName' already exists at '$directoryPath'.";
            }

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



