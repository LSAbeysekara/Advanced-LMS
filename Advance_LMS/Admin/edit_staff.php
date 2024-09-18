<!DOCTYPE html>
<html lang="en">
<?php include('config/constant.php'); ?>
<?php 
session_start();
if (!isset($_SESSION['admin_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/admin'); </script>";
} else {
    
    ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Staff</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
        $tch_id = $_GET['id'];

        $sql = "SELECT * FROM `tb_adminstration` where username='$tch_id'"; // Adjust the table and column names

        $result = $conn->query($sql);


        while ($row = $result->fetch_assoc()) {

        ?>
            <div class="content-body">

                <div class="row page-titles mx-0">
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Staff</a></li>
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
                                        <form class="form-valide" method="post" id="staffForm">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">Username <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-username" value="<?php echo $row['username'] ?>" name="val-username" placeholder="Enter a username.." readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">User Type <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select name="val-usertype" class="form-control" required>
                                                        <option value="admin" <?php echo ($row['usertype'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                        <option value="staff" <?php echo ($row['usertype'] == 'staff') ? 'selected' : ''; ?>>Staff</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">Name <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-name" name="val-name" value="<?php echo $row['name'] ?>" placeholder="Enter a name..">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-email" name="val-email" value="<?php echo $row['email'] ?>" placeholder="Your valid email.."><span id="emailMessage" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="button" class="btn btn-primary" onclick="checkEmailAndGenerate()">Generate</button>
                                            </div>
                                        </div> -->

                                            <!-- <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-password">Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="val-password" name="val-password" placeholder="Choose a safe one.." readonly>
                                            </div>
                                        </div> -->


                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-nic">NIC <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-nic" value="<?php echo $row['nic'] ?>" name="val-nic" placeholder="842102840V / 200021002840">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-address">Address <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-address" value="<?php echo $row['address'] ?>" name="val-address" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-phoneus">Phone <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="val-phoneus" value="<?php echo $row['phone'] ?>" name="val-phoneus" placeholder="0777123456">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Status <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <select name="val-status" class="form-control" required>
                                                        <option value="active" <?php echo ($row['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                                        <option value="inactive" <?php echo ($row['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-cv">CV <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="file" class="form-control" id="val-cv" name="val-cv" placeholder="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-certificate">Cetificate <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="file" class="form-control" id="val-certificate" name="val-certificate" placeholder="5">
                                            </div>
                                        </div> -->

                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="button" class="btn btn-primary" id="submitBtn" onclick="submitForm()">Submit</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <?php } ?>
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
        function submitForm() {
            var formData = new FormData($('#staffForm')[0]);

            $.ajax({
                type: 'POST',
                url: 'update_staff.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert(result.message);
                    } else {
                        alert('Error: ' + result.message);
                    }
                },
                error: function() {
                    alert('Error: Unable to communicate with the server.');
                }
            });
        }
    </script>
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html><?php } ?>