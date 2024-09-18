<?php include('config/constant.php');

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
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
                                        <form class="form-valide" method="post">

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Title <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title.." required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Notice Type <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <select name="notice_type" class="form-control" required onchange="handleNoticeTypeChange(this)">
                                                        <option value="all">All Student</option>
                                                        <option value="course">For Course</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Content <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <textarea type="text" class="form-control" id="content" name="content" placeholder="Enter content here.." required></textarea>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group" id="abc" style="display: none;"></div> -->


                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Course <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="course_id" name="course_id" required>
                                                    </select>
                                                </div>
                                            </div>



                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">End Date <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-6">
                                            <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Enter end date.." required>
                                        </div>
                                    </div>

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
                                            <!-- <input type="hidden" class="btn btn-primary" name="submit" value="submit"> -->
                                            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
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
        <script>
            jQuery.noConflict();

            // Your code using $ as an alias for jQuery
            function getTeacherSuggestions(term) {
                $.ajax({
                    url: 'fetch_course.php',
                    method: 'GET',
                    data: {
                        action: 'getTeacherSuggestions',
                        term: term
                    },
                    dataType: 'json',
                    success: function(response) {

                        $('#course_id').select2({
                            data: response.results
                        });
                    }
                });
            }
            jQuery(document).ready(function($) {
                $('#course_id').select2({
                    placeholder: 'Select a course',
                    minimumInputLength: 1,
                    ajax: {
                        url: 'fetch_course.php',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                action: 'getTeacherSuggestions',
                                term: params.term
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
        <script>
            tinymce.init({
                selector: 'textarea#content',
                plugins: ' autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [{
                        value: 'First.Name',
                        title: 'First Name'
                    },
                    {
                        value: 'Email',
                        title: 'Email'
                    },
                ],
                // ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
            });
        </script>

        <script>
            function handleNoticeTypeChange(selectElement) {
                var coursesSection = document.getElementById('abc');
                var courseSelect = document.getElementById('course_id');
                var contentTextarea = document.getElementById('content');

                if (selectElement.value === 'course') {
                    courseSelect.disabled = false;
                    contentTextarea.required = true; // Make the content textarea required
                } else {
                    courseSelect.disabled = true;
                    contentTextarea.required = true; // Make the content textarea not required
                }
            }

            handleNoticeTypeChange(document.querySelector('[name="notice_type"]'));
        </script>
        <script>
            jQuery(document).ready(function($) {
                $('.form-valide').submit(function(e) {
                    e.preventDefault();

                    var title = $('#title').val();
                    var notice_type = $('[name="notice_type"]').val();
                    var content = $('#content').val();
                    var course_id = $('#course_id').val();
                    var end_date = $('#end_date').val();
                    var status = $('[name="status"]').val();
                    var submit = $('[name="submit"]').val();

                    var formData = {
                        title: title,
                        notice_type: notice_type,
                        content: content,
                        course_id: course_id,
                        end_date: end_date,
                        status: status,
                        submit: submit
                    };

                    $.ajax({
                        type: 'POST',
                        url: 'save_notice.php',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                // You can redirect or perform any other actions after successful submission
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Server error. Please try again later.',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                });
            });
        </script>

        <script src="plugins/common/common.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/gleek.js"></script>
        <script src="js/styleSwitcher.js"></script>

    </body>

    </html>
<?php } ?>