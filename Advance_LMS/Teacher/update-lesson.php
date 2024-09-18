<?php
include('config/constant.php');

if (isset($_POST['submit'])) {
    // get all the details from the form
    $les_name = $_POST['lesson_name'];
    $c_id = $_POST['c_id'];
    $les_id = $_POST['les_id'];
    $status = $_POST['status'];
    $old_file = $_POST['old_file'];
    $old_file_type = $_POST['file_type'];

    // check whether upload button is clicked or not
    if (isset($_FILES['file'])) {
        // upload button clicked
        $file_name = $_FILES['file']['name']; // new file's name

        // check whether the file is available or not
        if ($file_name != "") {
            // get the destination path
            $src_path = $_FILES['file']['tmp_name']; // source path
            $dest_path = "./lessons/" . $file_name; // destination path

            // upload the file
            $upload = move_uploaded_file($src_path, $dest_path);

            // check whether the file is uploaded or not
            if (!$upload) {
                // failed to upload
                $_SESSION['update_file_error'] = "<div class='error'>Failed To Upload The File.</div></br></br>";
                header('location: course.php');
                die();
            }

            // remove the current file if available
            if ($file != "") {
                // current file is available
                // remove the file if uploaded
                $remove_path = "./lessons/" . $old_file;
                $remove = unlink($remove_path);

                // check whether the file is removed or not
                if (!$remove) {
                    // failed to remove current file
                    $_SESSION['update_lesson_error'] = "<div class='error'>Failed To Remove The Current File.</div></br></br>";
                    header('location: ' . SITEURL . './course.php');
                    die();
                }
            }

            if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                // Get the file type
                $file_type = $_FILES['file']['type'];
            }else{
                header("Location: ./course.php");
    
            }

        } else {
            $file_name = $old_file;
            $file_type = $old_file_type;
        }
    } else {
        $file_name = $old_file;
        $file_type = $old_file_type;
    }

        $sql = "UPDATE tb_lesson SET
            les_name = '$les_name',
            file = '$file_name',
            file_type = '$file_type',
            status = '$status'
            WHERE les_id='$les_id' 
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query is executed or not
        
        if($res==true){

            $_SESSION['update_image-ok'] = "<div class='success'>Ok</div></br></br>"; 
            header('location:course.php');
        
        }
        else
        {
            //failed to update
            $_SESSION['update_image-error'] = "<div class='error'>Error</div></br></br>";
            header('location:course.php');
        }

    }
?>