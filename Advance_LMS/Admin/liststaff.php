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
    <title>List of Staff</title>
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Sfaff</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">List of Staff</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Staff List</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered " id="staffTable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>User Type</th>
                                                <th>Email</th>
                                                <th>NIC</th>
                                                <th>Username</th>
                                                <th>Phone</th>
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
            Content body end
        ***********************************-->


            <!--**********************************
            Footer start
        ***********************************-->
            <!-- <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div> -->
            <!--**********************************
            Footer end
        ***********************************-->

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
        // Initialize DataTable
        var table = $j('#staffTable').DataTable({
            "ajax": "staffdata.php",
            "columns": [{
                    "data": "name"
                },
                {
                    "data": "usertype"
                },
                {
                    "data": "email"
                },
                {
                    "data": "nic"
                },
                {
                    "data": "username"
                },
                {
                    "data": "phone"
                },
                {
                    "data": "status"
                },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        if (full.usertype === 'admin') {
                            return "<button class='edit-btn btn btn-primary' disabled>Edit</button> &nbsp;&nbsp; <button class='delete-btn btn btn-danger'>Delete</button>";
                        } else {
                            return "<button class='edit-btn btn btn-primary'>Edit</button> &nbsp;&nbsp; <button class='delete-btn btn btn-danger'>Delete</button>";
                        }
                    }
                }
            ],
            "createdRow": function(row, data, dataIndex) {
                $j(row).find('.edit-btn').on('click', function() {
                    // Access the username from the current row's data object
                    var username = data.username;
                    // Perform edit action with the username
                    window.location.href = 'edit_staff.php?id=' + username;
                });

                $j(row).find('.delete-btn').on('click', function() {
                    var username = data.username;
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
                            deleteStaff(username);
                        }
                    });
                });
            }
        });

        function deleteStaff(username) {
            $j.ajax({
                type: 'POST',
                url: 'delete_staff.php',
                data: {
                    id: username
                },
                success: function(response) {
                    // Handle success response
                    Swal.fire(
                        'Deleted!',
                        'Staff has been deleted.',
                        'success'
                    );
                    // Refresh DataTable after deletion
                    table.ajax.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    Swal.fire(
                        'Error!',
                        'An error occurred while deleting staff.',
                        'error'
                    );
                }
            });
        }
    });


</script>
</body>

</html><?php } ?>