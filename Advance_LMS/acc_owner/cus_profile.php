<!DOCTYPE html>
<html lang="en">
<?php
include('config/constant.php'); 

if (!isset($_SESSION['username'])) {
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
        <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/lightcase.css">
    <link rel="stylesheet" href="assets/css/style.css">
        <style>
        span {
            color: red;
        }

        #registrationForm {
            width: 100%;
        }

        .account-wrapper {
            max-width: none;
        }

        .cont {
            display: flex;
        }

        .left,
        .right {
            flex: 1;
            margin-right: 20px;
        }
    </style>


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
                                    <h4 class="card-title">Profile</h4>
                                    <div class="table-responsive">
                                    <?php
    $username = $_SESSION['username']; 
    $sql = "SELECT * FROM `tb_customer` where username='$username'"; // Adjust the table and column names

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {

    ?>

        <!-- Login Section Section Starts Here -->

                <div class="account-wrapper">
                    <div class="media align-items-center mb-4">
                        <img class="mr-3" src="./images/profile-pic/<?php echo $row['pro_img'] ?>" alt="" width="120px" height="120px">
                    </div>

                    <form class="account-form" action="edit_profile.php" method="post" enctype="multipart/form-data">
                        <div class="cont">
                            <div class="left">
                                <div class="form-group" style="text-align: left;">
                                    <span>Name:</span>
                                    <input type="text" placeholder="Name" name="name" value="<?php echo $row['cus_name'] ?>" readonly required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>Username:</span>
                                    <input type="text" placeholder="User Name" name="username" value="<?php echo $row['username'] ?>" readonly required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>Email:</span>
                                    <input type="email" placeholder="Email" name="email" value="<?php echo $row['email'] ?>" readonly required>
                                </div>
                            </div>
                            <div class="right">
                                <div class="form-group" style="text-align: left;">
                                    <span>Mobile:</span>
                                    <input type="text" placeholder="mobile" name="mobile" value="<?php echo $row['mobile'] ?>" readonly required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>Address:</span>
                                    <input type="text" placeholder="Address" name="address" value="<?php echo $row['address'] ?>" readonly required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>ZIP code:</span>
                                    <input type="text" placeholder="zip code" name="zip" value="<?php echo $row['zip'] ?>" readonly required>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="lab-btn"><span>Edit Profile</span></button>
                        </div>
                    </form>
                </div>

<?php } ?>
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
    <script src="plugins/common/common.min.js" defer></script>
                <script src="js/custom.min.js" defer></script>
                <script src="js/settings.js" defer></script>
                <script src="js/gleek.js" defer></script>
                <script src="js/styleSwitcher.js" defer></script>
    </body>

</html><?php } ?>