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
    
  
    <title>Edit Lesson</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">

    <link href="css/style.css" rel="stylesheet">

    <script src="https://cdn.tiny.cloud/1/ipootvjlv9vz4p1d1x91ok27oce25gt4no6r0tddj5c98lsw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


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

                                    if(isset($_GET['aid'])){
                                        $act_id = $_GET['aid'];

                                        $sql = "SELECT * FROM tb_activity WHERE act_id = '$act_id'";

                                        $res = mysqli_query($conn, $sql);

                                        $count = mysqli_num_rows($res);

                                        if($count>0){
                                            
                                            while($row=mysqli_fetch_assoc($res)){
                                                $act_name = $row['act_name'];
                                                $file_name = $row['file_name'];
                                                $file_type = $row['file_type'];
                                                $content = $row['content'];
                                                $deadline = $row['deadline'];
                                                $status = $row['status'];
                                            } ?>

                                        <?php
                                        }else{
                                            $_SESSION['add-error'] = "error";
                                            header('location: course.php');
                                        }
                                        
                                    }
                                    else{
                                        //$_SESSION['add-error'] = "error";
                                        //header('location: course.php');
                                    }
                                    ?>

                                    <h3>Edit Assignment</h3>
                                    <div class="form-validation">
                                        <form class="form-valide" action="update-assignment.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Assignment Name <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="assignment_name" name="assignment_name" placeholder="Enter assignment name.." value="<?php echo $act_name; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Assignment File<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="file" name="file" id="fileInput" accept=".pdf, .docx, .doc, .pptx, .pptx, .xlsx, .xls, .jpg, .jpeg, .png, .gif, .mp3, .wav, .mp4, .mov, .txt, .py, .java, .html, .css, .js, .epub, .mobi, .csv, .one">
                                                    <br><br>
                                                    <label id="fileNameDisplay" style="font-size: 16px;">Selected file: None</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Deadline<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <?php date_default_timezone_set('Asia/Colombo'); ?>
                                                   <input type="datetime-local" name="deadline" value="<?php echo $deadline; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Content<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                   <textarea name="content" id="content" cols="30" rows="10"><?php echo $content; ?></textarea>
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
                                            
                                            <input type="hidden" name="act_id" value="<?php echo $act_id; ?>">
                                            <input type="hidden" name="old_file" value="<?php echo $file_name; ?>">
                                            <input type="hidden" name="old_file_type" value="<?php echo $file_type; ?>">

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

    <script>
        // Get the file input element
        const fileInput = document.getElementById('fileInput');
        // Get the display element
        const fileNameDisplay = document.getElementById('fileNameDisplay');

        // Check if there's a file previously selected (e.g., from PHP or another server-side mechanism)
        const previousFileName = "<?php echo $file_name; ?>";
        if (previousFileName) {
            fileNameDisplay.textContent = 'Uploaded File: ' + previousFileName;
        }

        // Add an event listener to the file input
        fileInput.addEventListener('change', function() {
            // Update the display with the selected file name
            fileNameDisplay.textContent = 'Selected file: ' + (fileInput.files.length > 0 ? fileInput.files[0].name : 'None');
        });
    </script>

    <script>
        tinymce.init({
        selector: 'textarea#content',
        plugins: ' autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>


    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>
<?php } ?>