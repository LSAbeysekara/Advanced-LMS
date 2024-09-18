<?php include('config/constant.php'); ?>
<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Add Course</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">
        <!-- Custom Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


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
            if ($_SESSION['add-error'] == "success") {
        ?>
                <script>
                    Swal.fire(
                        'Success!',
                        'Student has been added to course.',
                        'success'
                    );
                </script>

            <?php
                unset($_SESSION['add-error']);
            } else { ?>

                <script>
                    Swal.fire(
                        'erroe!',
                        'error adding the course.',
                        'error'
                    );
                </script>

        <?php
                unset($_SESSION['add-error']);
            }
        } ?>

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

                <div class="row page-titles mx-0">
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./index.php">Courses</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Course</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <?php
                $sql = "SELECT c_id FROM tb_courses ORDER BY c_id DESC LIMIT 1";

                $result = $conn->query($sql);
                $lastData = "";

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $lastData = $row['c_id'];
                } else {
                    //echo "No data found in the column";
                }

                $string = $lastData;
                preg_match_all('/\d+/', $string, $matches);
                $number = implode('', $matches[0]);

                ?>


                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-validation">
                                        <form class="form-valide" action="st_enroll.php" method="post">

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Student<span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="student_id" name="student_id" required>
                                                    </select>
                                                </div>
                                            </div>

                                            <input type="hidden" name="course_id" value="<?php echo $c_id ?>">

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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            jQuery.noConflict();

            function getStudentSuggestions(keyword) {
                $.ajax({
                    url: 'fetch_student.php',
                    method: 'GET',
                    data: {
                        action: 'getStudentSuggestions',
                        keyword: keyword
                    },
                    dataType: 'json',
                    success: function(response) {

                        $('#student_id').select2({
                            data: response.results
                        });
                    }
                });
            }

            jQuery(document).ready(function($) {
                $('#student_id').select2({
                    placeholder: 'Select a student',
                    minimumInputLength: 1,
                    ajax: {
                        url: 'fetch_student.php',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                action: 'getStudentSuggestions',
                                keyword: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.results
                            };
                        },
                        cache: true
                    }

                });
            })
        </script>

        <script src="plugins/common/common.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/gleek.js"></script>
        <script src="js/styleSwitcher.js"></script>

    </body>

    </html><?php } ?>