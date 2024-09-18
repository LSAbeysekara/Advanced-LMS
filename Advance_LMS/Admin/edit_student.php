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
        <title>Student</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        <!-- Custom Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>
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
            <div class="content-body">

                <div class="row page-titles mx-0">
                    <div class="col p-md-0">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Student</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">edit Student</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <?php
include('config/constant.php');


//$usernamea   = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;

$usernamea = $_GET['id'];
$sqld = "SELECT * FROM tb_student WHERE username = '$usernamea'";

$resd = mysqli_query($conn, $sqld);

$rows = mysqli_fetch_assoc($resd);



?>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-validation">
                                        <form class="form-valide" method="post" action="update_student_details.php">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span></label>
                                                <div class="col-lg-6">
                                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $rows['email']; ?>" readonly><span id="emailMessage" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="username">Username <span class="text-danger"></span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $rows['username']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">Full Name <span class="text-danger"></span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $rows['st_name']; ?>" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">NIC <span class="text-danger"></span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="nic" name="nic" value="<?php echo $rows['nic']; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">Mobile Number <span class="text-danger"></span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $rows['mobile']; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">Date of Birth <span class="text-danger"></span></label>
                                                <div class="col-lg-6">
                                                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $rows['date_of_birth']; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="val-username">Address <span class="text-danger"></span></label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $rows['address']; ?>" >
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary" id="submitBtn" onclick="submitForm()" >Update</button>
                                                   
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

        <script src="plugins/common/common.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/gleek.js"></script>
        <script src="js/styleSwitcher.js"></script>

    </body>

</html>
<?php } ?>