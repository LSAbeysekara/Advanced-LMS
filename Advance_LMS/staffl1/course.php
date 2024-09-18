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

    $sql = "SELECT 
    c.`c_id`, 
    c.`c_name`, 
    c.`c_type`, 
    t.`name` AS `teacher_name`, 
    c.`status`,
    COUNT(e.`st_id`) AS `num_of_students`
FROM 
    `tb_courses` c
JOIN 
    `tb_teacher` t ON c.`t_id` = t.`tchr_id`
LEFT JOIN 
    `tb_enrollment` e ON c.`c_id` = e.`course_id`
WHERE 
    c.`c_id` = '$c_id'
GROUP BY 
    c.`c_id`, 
    c.`c_name`, 
    c.`c_type`, 
    t.`name`, 
    c.`status`;

    ";

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
                    <p style="margin: 15px 0 0 15px;">Teacher:
                        <?php echo $row['teacher_name']; ?>
                    </p>
                    <p style="margin: 15px 0 0 15px;">No. of Student:
                        <?php echo $row['num_of_students'];  
                        ?> <button class="badge badge-info" onclick="redirectToAppointment()">List Student</button>
                    </p>


                    <h3 style="margin: 15px 0 0 15px;">Lessons</h3>

                <?php } ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Lessons List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered " id="lessonTable">
                                            <thead>
                                                <tr>
                                                    <th>Lesson ID</th>
                                                    <th>Lesson Name</th>
                                                    <th>File Type</th>
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


                <h3 style="margin: 15px 0 0 15px;">Assignments</h3>


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Assignments List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered " id="assignTable">
                                            <thead>
                                                <tr>
                                                    <th>Assignment ID</th>
                                                    <th>Assignment Name</th>
                                                    <th>Deadline</th>
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
    function redirectToAppointment() {
      // Redirect to appointment.php
      window.location.href = "enrolledstudent.php?id=<?php echo $c_id ?>";
    }
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
                    $j('#lessonTable, #assignTable').on('draw.dt', function() {
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
                });
            </script>



            <script>
                $j(document).ready(function() {
                    // Initialize DataTable
                    var table = $j('#lessonTable').DataTable({
                        "ajax": {
                            "url": "lessondata.php",
                            "data": function(d) {
                                d.cid = "<?php echo $c_id; ?>";
                            }
                        },
                        "columns": [{
                                "data": "les_id"
                            },
                            {
                                "data": "les_name"
                            },
                            {
                                "data": "file_type"
                            },
                            {
                                "data": "status"
                            },
                            {
                                "data": null,
                                "defaultContent": "<button class='view-btn btn btn-info'>View</button> &nbsp;&nbsp;<button class='delete-btn btn btn-danger'>Delete</button>"
                            },
                            // {
                            //     "data": null,
                            //     "defaultContent": ""
                            // }
                        ],
                        "createdRow": function(row, data, dataIndex) {
                            $j(row).find('.view-btn').on('click', function() {
                                var file = data.file;
                                window.location.href = 'lesson_view.php?id=' + file;
                            });

                            $j(row).find('.edit-btn').on('click', function() {
                                var les_id = data.les_id;
                                window.location.href = 'edit_lesson.php?id=' + les_id;
                            });

                            $j(row).find('.delete-btn').on('click', function() {
                                var les_id = data.les_id;
                                // Show SweetAlert2 confirmation
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "You won't be able to revert this!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, delete it!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // If confirmed, proceed with deletion
                                        deleteLesson(les_id);
                                    }
                                });
                            });

                        }
                    });

                    function deleteLesson(les_id) {
                        $j.ajax({
                            type: 'POST',
                            url: 'delete_lesson.php',
                            data: {
                                id: les_id
                            },
                            success: function(response) {
                                // Handle success response
                                Swal.fire(
                                    'Deleted!',
                                    'Lesson has been deleted.',
                                    'success'
                                );
                                // Refresh DataTable after deletion
                                table.ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                // Handle error response
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting Lesson.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            </script>
            <script>
                $j(document).ready(function() {
                    // Initialize DataTable
                    var table = $j('#assignTable').DataTable({
                        "ajax": {
                            "url": "assigndata.php",
                            "data": function(d) {
                                d.cid = "<?php echo $c_id; ?>";
                            }
                        },
                        "columns": [{
                                "data": "act_id"
                            },
                            {
                                "data": "act_name"
                            },
                            {
                                "data": "deadline"
                            },
                            {
                                "data": "status"
                            },
                            {
                                "data": null,
                                "defaultContent": "<button class='view-btn btn btn-info'>View</button> &nbsp;&nbsp;<button class='delete-btn btn btn-danger'>Delete</button>"
                            }
                        ],
                        "createdRow": function(row, data, dataIndex) {
                            $j(row).find('.view-btn').on('click', function() {
                                var act_id = data.act_id;
                                window.location.href = 'view_assignment.php?id=' + act_id;
                            });

                            $j(row).find('.edit-btn').on('click', function() {
                                var act_id = data.act_id;
                                window.location.href = 'edit_assignment.php?id=' + act_id;
                            });

                            // $j(row).find('.delete-btn').on('click', function () {
                            //     var act_id = data.act_id;
                            //     window.location.href = 'delete_assignment.php?id=' + act_id;
                            // });

                            $j(row).find('.delete-btn').on('click', function() {
                                var act_id = data.act_id;
                                // Show SweetAlert2 confirmation
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "You won't be able to revert this!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, delete it!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // If confirmed, proceed with deletion
                                        deleteAssignment(act_id);
                                    }
                                });
                            });
                        }
                    });

                    function deleteAssignment(act_id) {
                        $j.ajax({
                            type: 'POST',
                            url: 'delete_assignment.php',
                            data: {
                                id: act_id
                            },
                            success: function(response) {
                                // Handle success response
                                Swal.fire(
                                    'Deleted!',
                                    'Assignment has been deleted.',
                                    'success'
                                );
                                // Refresh DataTable after deletion
                                table.ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                // Handle error response
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting Assignment.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            </script>
        





        </body>

    </html>
<?php } ?>