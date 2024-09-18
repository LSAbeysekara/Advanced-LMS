<!DOCTYPE html>
<html lang="en">
<?php
$admin_name = isset($_COOKIE['admin_name']) ? $_COOKIE['admin_name'] : null;
$user_type = isset($_COOKIE['user_type']) ? $_COOKIE['user_type'] : null;
$admin_id   = isset($_COOKIE['admin_id']) ? $_COOKIE['admin_id'] : null;


session_start();
$_SESSION['admin_name'] = $admin_name;
$_SESSION['user_type'] = $user_type;
$_SESSION['admin_id'] = $admin_id;
?>
<!DOCTYPE html>
<html lang="en">

<?php if (!isset($_SESSION['admin_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/admin'); </script>";
} else {

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

  
    <title>Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">
    

    <link href="css/style.css" rel="stylesheet">

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

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="liststudent.php">
                            <div class="card gradient-1">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Stduents</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">850</h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="listteacher.php">
                            <div class="card gradient-2">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Teachers</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">78</h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="listcourse.php">
                            <div class="card gradient-3">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Courses</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">120</h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-4">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Posted Jobs</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">670</h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-5">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Customers</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">4565</h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-7">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Selling Items</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">92</h2>
                                        <p class="text-white mb-0">Jan - March 2024</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-6">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Revenue</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">Rs. 54560.00</h2>
                                        <p class="text-white mb-0">Jan - March 2024</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-7">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Profit (10%)</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">Rs. 5456.00</h2>
                                        <p class="text-white mb-0">Jan - March 2024</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
       
                </div>

                
            <!-- #/ container -->
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





   

</body>

</html>
<?php } ?>