<?php include('config/constant.php'); ?>
<?php 
session_start();
if (!isset($_SESSION['admin_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/admin'); </script>";
} else {
    
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Course</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


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
        <?php
        $cou_id = $_GET['id'];

        $sql = "SELECT * FROM `tb_courses` where c_id='$cou_id'"; 

        $result = $conn->query($sql);


        while ($row = $result->fetch_assoc()) {

        ?>
        
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./index.php">Courses</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Course</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" action="edit-course.php" method="post">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Course ID <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="course_id" name="course_id" value="<?php echo $row['c_id'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Course Name <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="course_name" value="<?php echo $row['c_name'] ?>" name="course_name" placeholder="Enter course name.." required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Teacher ID <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control" id="teacher_id"  name="teacher_id" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Status <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select name="status" class="form-control" required>
                                                        <option value="active" <?php echo ($row['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                                        <option value="inactive" <?php echo ($row['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
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
            <!-- #/ container --><?php } ?>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">

        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script>
    jQuery.noConflict();
    jQuery(document).ready(function ($) {
        // Your code using $ as an alias for jQuery

        <?php
        $cou_id = $_GET['id'];
        $sql = "SELECT * FROM `tb_courses` where c_id='$cou_id'";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
        ?>

        // Fetch the selected teacher ID from the database
        var selectedTeacherId = <?php echo $row['t_id']; ?>;

        // Initialize Select2 with the fetched teacher data
        $('#teacher_id').select2({
            placeholder: 'Select a teacher',
            ajax: {
                url: 'fetch_teachers.php',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },

        });
        var selectedOption = new Option('test', selectedTeacherId, true, true);

        // Append the option to the Select2 dropdown
        select2.append(selectedOption).trigger('change');
        // Set the selected teacher in the dropdown
       // $('#teacher_id').val(selectedTeacherId).trigger('change');
        
        <?php
        }
        ?>
    });
</script>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html><?php } ?>