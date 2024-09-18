<?php
session_start();
if (!isset($_SESSION['admin_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else {

?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include('config/constant.php');



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


                <div class="container-fluid">
                    <button class="btn btn-info" id="addStudentform">Add New</button>
                </div>

                <div style="display:none;" id="enrolledform">
                    <h3 style="margin: 15px 0 0 15px;">ADD Categories</h3>

                    <?php // } 
                    ?>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Create Categories</h4>

                                        <form class="form-valide"  method="post">

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Category Name<span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="category" width="150%" required>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary" name="submit">Save</button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <h3 style="margin: 15px 0 0 15px;">Category</h3>


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Category List</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered " id="catTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
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
        $j(document).ready(function() {
    var table = $j('#catTable').DataTable({
        "ajax": "product_category.php?action=get_categories",
        "columns": [
            { "data": "procat_id" },
            { "data": "procatdesc" },
            { "data": "status" },
            { "data": null, "render": function(data, type, row) {
                return '<button class="change-status-btn btn ' + (row.status === "Active" ? 'btn-danger' : 'btn-success') + '" data-procat_id="' + row.procat_id + '">' + (row.status === "Active" ? 'Inactive' : 'Active') + '</button>&nbsp; &nbsp;<button class="edit-btn btn btn-primary" data-procat_id="' + row.procat_id + '">Edit</button>' ;
                        }}
        ]
    });

    $j('#catTable').on('click', '.change-status-btn', function() {
        var procat_id = $j(this).data('procat_id');
        var newStatus = $j(this).text() === "Active" ? "Active" : "Inactive";
        changeStatus(procat_id, newStatus);
    });

    $j('#catTable').on('click', '.edit-btn', function() {
        var procat_id = $j(this).data('procat_id');
        openEditPopup(procat_id);
    });

    function changeStatus(procat_id, newStatus) {
        $j.ajax({
            url: 'product_category.php?action=change_status',
            type: 'POST',
            data: { procat_id: procat_id, status: newStatus },
            success: function(response) {
                table.ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert("An error occurred while changing status.");
            }
        });
    }

    // Handle form submission
    $j('.form-valide').submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = $j(this).serialize(); // Serialize form data

        // Send AJAX request to save data
        $j.ajax({
            url: 'product_category.php?action=save_category',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle success response
                if (response === 'success') {
                    // Reload DataTable after successful save
                    table.ajax.reload();
                    // Optionally, display a success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Category saved successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while saving category!'
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                console.error(error);
                alert("An error occurred while saving category.");
            }
        });
    });
    
    function openEditPopup(procat_id) {
        Swal.fire({
            title: 'Edit Category',
            input: 'text',
            inputValue: '',
            showCancelButton: true,
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            preConfirm: (newName) => {
                return $j.ajax({
                    url: 'product_category.php?action=update_category',
                    type: 'POST',
                    data: { procat_id: procat_id, new_name: newName },
                    dataType: 'text',   
                })
                .then(response => {
                    
                    if (response.trim() === 'success') {
                       return Swal.fire({
                            icon: 'success',
                            title: 'Category updated successfully!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        table.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'An error occurred while updating category!'
                        });
                    }
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while updating category!'
                    });
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        });
    }
});
        </script>






    </body>

    </html>
<?php } ?>