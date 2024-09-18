<!DOCTYPE html>
<html lang="en">
<?php
session_start(); 
include('config/constant.php');
$c_id = $_GET['id'];
 if (!isset($_SESSION['teacher_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
  } else {
  
    ?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    

    <title>Add Assignment</title>
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
    <?php if (isset($_SESSION['add-error'])) {
        if ($_SESSION['add-error']=="success") { 
        ?>
            <script>
                Swal.fire(
                    'Success!',
                    'Lesson has been added.',
                    'success'
                );
            </script>
                
        <?php 
    unset($_SESSION['add-error']);
    }else{?>

<script>
                Swal.fire(
                    'erroe!',
                    'Lesson adding the course.',
                    'error'
                );
            </script>

        <?php 
    unset($_SESSION['add-error']); } }?>
    
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
                                    <h3>New Assignment</h3>
                                    <div class="form-validation">
                                        <form class="form-valide" action="assignment_add.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Assignment Name <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="assignment_name" name="assignment_name" placeholder="Enter lesson name.." required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Assignment File<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="file" name="file" accept=".pdf, .docx, .doc, .pptx, .pptx, .xlsx, .xls, .jpg, .jpeg, .png, .gif, .mp3, .wav, .mp4, .mov, .txt, .py, .java, .html, .css, .js, .epub, .mobi, .csv, .one" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Deadline<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <?php date_default_timezone_set('Asia/Colombo'); ?>
                                                   <input type="datetime-local" name="deadline" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Content<span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                   <textarea name="content" id="content" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>

                                            <input type="hidden" name="c_id" value="<?php echo $c_id;?>">
                                            
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Status <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select name="status" class="form-control" required>
                                                        <option value="active">Active</option>
                                                        <option value="inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            

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


  

</body>

</html>
<?php } ?>