<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else {

?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>List Of Course</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        <!-- Custom Stylesheet -->

        <link href="css/style.css" rel="stylesheet">
        <!-- Include jQuery library -->

        <!-- Include DataTables CSS and JS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Teacher</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">List of Teachers</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Course List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered " id="courseTable">
                                            <thead>
                                                <tr>
                                                    <th>Course ID</th>
                                                    <th>Course Name</th>
                                                    <th>Course Type</th>
                                                    <th>Teacher Name</th>
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
                <!--**********************************
        Main wrapper end
    ***********************************-->

                <!--**********************************
        Scripts
    ***********************************-->

                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
                    $j(document).ready(function() {
                        
                        var table = $j('#courseTable').DataTable({
                            "ajax": "locdatarha.php", 
                            
                            "columns": [{
                                    "data": "c_id"
                                },
                                {
                                    "data": "c_name"
                                },
                                {
                                    "data": "c_type"
                                },
                                {
                                    "data": "teacher_name"
                                },
                                {
                                    "data": "status"
                                },
                                {
                                    "data": null,
                                    "defaultContent": "<button class='view-btn btn btn-info'>View</button>  &nbsp;&nbsp; <button class='delete-btn btn btn-danger'>Take Action</button>"
                                }
                            ],
                            "createdRow": function(row, data, dataIndex) {
                                $j(row).find('.view-btn').on('click', function() {
                                    // Access the username from the current row's data object
                                    var c_id = data.c_id;
                                    // Perform edit action with the username
                                    window.location.href = 'accomodation_view.php?acom_id=' + c_id;
                                });

                                $j(row).find('.delete-btn').on('click', function() {
                                    var orderId = data.c_id;
                                    var currentStatus = $j(this).data('status');
                                    // Show SweetAlert2 confirmation
                                    // console.log(data)
                                    // console.log(orderId)
                                    Swal.fire({
                                        title: 'Change Order Status',
                                        input: 'select',
                                        inputOptions: {
                                            'Active': 'Active',
                                            'Inactive': 'Inactive',
                                            'Suspended': 'Suspended'
                                        },
                                        inputValue: currentStatus,
                                        showCancelButton: true,
                                        confirmButtonText: 'Submit',
                                        showLoaderOnConfirm: true,
                                        preConfirm: (status) => {
                                            return $j.ajax({
                                                url: 'update_course_status.php',
                                                type: 'POST',
                                                data: {
                                                    orderId: orderId,
                                                    status: status
                                                }
                                            });
                                        },
                                        allowOutsideClick: () => !Swal.isLoading()
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Reload DataTable on success
                                            table.ajax.reload();
                                            Swal.fire(
                                                'Success!',
                                                'Order status has been updated.',
                                                'success'
                                            );
                                            window.location.href = '';
                                        }
                                    });
                                });


                            }
                        });

                    });
                </script>
    </body>

</html><?php } ?>