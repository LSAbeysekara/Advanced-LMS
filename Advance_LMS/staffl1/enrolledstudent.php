<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else {

?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include('config/constant.php');
    $c_id = $_GET['id'];

    $sql = "SELECT c.`c_id`, c.`c_name`, c.`c_type`, t.`name` AS `teacher_name`, c.`status`
FROM `tb_courses` c
JOIN `tb_teacher` t ON c.`t_id` = t.`tchr_id` where c_id='$c_id'";

    $result = $conn->query($sql);


    while ($row = $result->fetch_assoc()) {
    ?>

        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width,initial-scale=1">



            <title>Lesson</title>
            <!-- Favicon icon -->
            <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
            <!-- Custom Stylesheet -->

            <link href="css/style.css" rel="stylesheet">
            <!-- Include jQuery library -->

            <!-- Include DataTables CSS and JS -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                    <h2 style="margin: 15px 0 0 15px;">Course:
                        <?php echo $row['c_name']; ?>
                    </h2>

                    <div class="container-fluid">
                        <button class="btn btn-info" id="addStudentform">Add Student</button>
                    </div>

                    <div style="display:none;" id="enrolledform">
                        <h3 style="margin: 15px 0 0 15px;">Enrollment</h3>

                    <?php } ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Enrollment</h4>

                                        <form class="form-valide" action="st_enroll.php" method="post">

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Student<span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select class="form-control" id="student_id" name="student_id" width="150%" required>
                                                    </select>
                                                </div>
                                            </div>

                                            <input type="hidden" name="course_id" value="<?php echo $c_id ?>">

                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary" name="submit">Add Student</button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>

                    <h3 style="margin: 15px 0 0 15px;">Enrolled Student</h3>


                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Student List</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered " id="enrolledTable">
                                                <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Name</th>
                                                        <th>Enrolled Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>





            </div>

            <!--**********************************
        Main wrapper end
    ***********************************-->

            <!--**********************************
        Scripts
    ***********************************-->
            <script>
                // jQuery function to display form when button is clicked
                $(document).ready(function() {
                    $('#addStudentform').click(function() {
                        $('#enrolledform').show();
                    });
                });
            </script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js" defer></script>
            <script>
                var $j = jQuery.noConflict();
            </script>
            <script src="plugins/common/common.min.js" defer></script>
            <script src="js/custom.min.js" defer></script>
            <script src="js/settings.js" defer></script>
            <script src="js/gleek.js" defer></script>
            <script src="js/styleSwitcher.js" defer></script>
            <script>
                function getStudentSuggestions(keyword) {
                    $j.ajax({
                        url: 'fetch_student.php',
                        method: 'GET',
                        data: {
                            action: 'getStudentSuggestions',
                            keyword: keyword
                        },
                        dataType: 'json',
                        success: function(response) {
                            $j('#student_id').select2({
                                data: response.results
                            });
                        }
                    });
                }

                $j(document).ready(function() {

                    $j('#student_id').select2({
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
                        },
                        escapeMarkup: function(markup) {
                            return markup;
                        },
                        templateResult: function(data) {
                            if (data.loading) return data.text;
                            var markup = "<div class='select2-result-repository clearfix'>" +
                                "<div class='select2-result-repository__title'>" + data.text + "</div>" +
                                "</div>";
                            return markup;
                        },
                        templateSelection: function(data) {
                            return data.text;
                        }
                    }).on('select2:select', function(e) {
                        // This event triggers after selecting an option, you can add additional actions if needed.
                    });

                });
            </script>

            <script>
                $j(document).ready(function() {
                    // Initialize DataTable
                    var table = $j('#enrolledTable').DataTable({
                        "ajax": {
                            "url": "enrolledstudentdata.php",
                            "data": function(d) {
                                d.cid = "<?php echo $c_id; ?>";
                            }
                        },
                        "columns": [{
                                "data": "username"
                            },
                            {
                                "data": "st_name"
                            },
                            {
                                "data": "enroll_date"
                            },
                            {
                                "data": "status"
                            },
                            {
                                "data": "enroll_id", // Include enrollment ID
                                "render": function(data, type, row) {
                                    // Check the status and create appropriate button
                                    if (row.status === "Active") {
                                        return '<button class="change-status-btn btn btn-danger" data-enroll-id="' + data + '">Inactive</button>';
                                    } else if (row.status === "Inactive") {
                                        return '<button class="change-status-btn btn btn-success" data-enroll-id="' + data + '">Active</button>';
                                    }
                                    return ''; // Return empty string if status is neither active nor inactive
                                }
                            }
                        ],

                    });



                    $j('#enrolledTable').on('click', '.change-status-btn', function() {
                        var enrollId = $j(this).data('enroll-id');
                        var rowData = table.row($j(this).parents('tr')).data();
                        var newStatus = rowData.status === "Active" ? "Inactive" : "Active";
                        updateEnrollmentStatus(enrollId, newStatus);
                    });

                    // Function to update student status
                    function updateEnrollmentStatus(enrollId, newStatus) {
                        // Send AJAX request to update status
                        $j.ajax({
                            type: 'POST',
                            url: 'update_enrollment_status.php',
                            data: {
                                enroll_id: enrollId,
                                status: newStatus
                            },
                            success: function(response) {
                                // Refresh DataTable after update
                                table.ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                // Handle error response
                                console.error(error);
                                alert("An error occurred while updating status.");
                            }
                        });
                    }
                });
            </script>






        </body>

    </html>
<?php } ?>