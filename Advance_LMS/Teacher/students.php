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

  
    <title>Students</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">

    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js" defer></script>

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
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script>
                var $j = jQuery.noConflict();
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