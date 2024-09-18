<?php   include('config/constant.php');  ?>
<?php
session_start(); 


 if (!isset($_SESSION['teacher_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/t_login'); </script>";
  } else {
    $c_id = $_GET['id'];
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    <title>Edit Lesson</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">

    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">


        <!--**********************************
            Header start
        ***********************************-->
        <?php include 'header.php'; ?>
        <!--**********************************
            Header end 
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include 'sidebar.php'; ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <?php

                                    if(isset($_GET['lid'])){
                                        $les_id = $_GET['lid'];

                                        $sql = "SELECT * FROM tb_lesson WHERE les_id = '$les_id'";

                                        $res = mysqli_query($conn, $sql);

                                        $count = mysqli_num_rows($res);

                                        if($count>0){
                                            
                                            while($row=mysqli_fetch_assoc($res)){
                                                $les_name = $row['les_name'];
                                                $file = $row['file'];
                                                $file_type = $row['file_type'];
                                                $status = $row['status'];
                                                $c_id = $row['c_id'];
                                            } ?>

                                        <?php
                                        }else{
                                            $_SESSION['add-error'] = "error";
                                            header('location: course.php');
                                        }
                                        
                                    }
                                    else{
                                        $_SESSION['add-error'] = "error";
                                        header('location: course.php');
                                    }
                                    ?>

                                    <h3>Edit Lesson</h3>
                                    <div class="form-validation">
                                        <form class="form-valide" action="update-lesson.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Lesson Name <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="lesson_name" name="lesson_name" placeholder="Enter lesson name.." value="<?php echo $les_name; ?>"  required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Lesson File<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="file" name="file" id="fileInput" accept=".pdf, .docx, .doc, .pptx, .pptx, .xlsx, .xls, .jpg, .jpeg, .png, .gif, .mp3, .wav, .mp4, .mov, .txt, .py, .java, .html, .css, .js, .epub, .mobi, .csv, .one">
                                                    <br><br>
                                                    <label id="fileNameDisplay" style="font-size: 16px;">Selected file: None</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Status <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select name="status" class="form-control" required>
                                                        <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="c_id" value="<?php echo $c_id; ?>">
                                            <input type="hidden" name="les_id" value="<?php echo $les_id; ?>">
                                            <input type="hidden" name="old_file" value="<?php echo $file; ?>">
                                            <input type="hidden" name="file_type" value="<?php echo $file_type; ?>">

                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #/ container -->
            </div>
        </div>
        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>


    <script src="./js/dashboard/dashboard-1.js"></script>

    <script>
        // Get the file input element
        const fileInput = document.getElementById('fileInput');
        // Get the display element
        const fileNameDisplay = document.getElementById('fileNameDisplay');

        // Check if there's a file previously selected (e.g., from PHP or another server-side mechanism)
        const previousFileName = "<?php echo $file; ?>";
        if (previousFileName) {
            fileNameDisplay.textContent = 'Uploaded File: ' + previousFileName;
        }

        // Add an event listener to the file input
        fileInput.addEventListener('change', function() {
            // Update the display with the selected file name
            fileNameDisplay.textContent = 'Selected file: ' + (fileInput.files.length > 0 ? fileInput.files[0].name : 'None');
        });
    </script>


</body>

</html>
<?php } ?>