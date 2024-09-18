<?php
session_start(); 


 if (!isset($_SESSION['teacher_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
  } else {
  
    ?>
<!DOCTYPE html>
<html lang="en">
<?php include('config/constant.php');
$c_id = $_GET['id'];

$sql = "SELECT * FROM `tb_courses` where c_id='$c_id'";

$result = $conn->query($sql);


while ($row = $result->fetch_assoc()) {
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">



        <title>Lessons</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        <!-- Custom Stylesheet -->

        <link href="css/style.css" rel="stylesheet">
      

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
                <h3 style="margin: 15px 0 0 15px;">Lessons - <?php echo $row['c_name']; ?></h3>

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
                            "defaultContent": "<button class='view-btn btn btn-info'>View</button> &nbsp;&nbsp;<button class='edit-btn btn btn-primary'>Edit</button> &nbsp;&nbsp;<button class='delete-btn btn btn-danger'>Delete</button>"
                        },
                        // {
                        //     "data": null,
                        //     "defaultContent": ""
                        // }
                    ],
                    "createdRow": function(row, data, dataIndex) {
                        $j(row).find('.view-btn').on('click', function() {
                            var file = data.file;
                            var c_id = data.c_id;
                            window.location.href = 'lesson_view.php?id=' + file + '&c_id=' + data.c_id;
                        });

                        $j(row).find('.edit-btn').on('click', function() {
                            var les_id = data.les_id;
                            window.location.href = 'edit_lesson.php?lid=' + les_id + '&id=' + data.c_id;
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







    </body>

</html>
<?php } ?>