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
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
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

        <?php 
        include 'config/constant.php';
        $result = mysqli_query($conn, "SELECT COUNT(*) AS total_students FROM tb_student");
        $row = mysqli_fetch_array($result);
        $total_students = $row['total_students'] ?: 0;
        ?>
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="liststudent.php">
                            <div class="card gradient-1">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Stduents</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white"><?php echo $total_students; ?></h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php 
        
        $result = mysqli_query($conn, "SELECT COUNT(*) AS total_teacher FROM tb_teacher WHERE user_type='LMS'");
        $row = mysqli_fetch_array($result);
        $total_teacher = $row['total_teacher'] ?: 0;
        ?>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="listteacher.php">
                            <div class="card gradient-2">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Teachers</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white"><?php echo $total_teacher; ?></h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php 
        
        $result = mysqli_query($conn, "SELECT COUNT(*) AS total_courses FROM tb_courses WHERE c_type='lms'");
        $row = mysqli_fetch_array($result);
        $total_courses = $row['total_courses'] ?: 0;
        ?>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="listcourse.php">
                            <div class="card gradient-3">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Courses</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white"><?php echo $total_courses; ?></h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php 
        
        $result = mysqli_query($conn, "SELECT COUNT(*) AS total_coursese FROM tb_courses WHERE c_type='extra'");
        $row = mysqli_fetch_array($result);
        $total_coursese = $row['total_coursese'] ?: 0;
        ?>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-4">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Posted Jobs</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white"><?php echo $total_coursese; ?></h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php 
        
        $result = mysqli_query($conn, "SELECT COUNT(*) AS total_customer FROM tb_customer WHERE usertype='customer'");
        $row = mysqli_fetch_array($result);
        $total_customer = $row['total_customer'] ?: 0;
        ?>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-5">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Customers</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white"><?php echo $total_customer; ?></h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php 
        
        $result = mysqli_query($conn, "SELECT SUM(od.quantity) AS total_selling_quantity
        FROM tb_order o
        JOIN tb_order_details od ON o.order_id = od.order_id
        WHERE o.order_status != 'cancelled'
        AND YEAR(o.order_date) = YEAR(CURRENT_DATE);
        ");
        $row = mysqli_fetch_array($result);
        $total_selling_quantity = $row['total_selling_quantity'] ?: 0;
        ?>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-7">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Selling Items</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white"><?php echo $total_selling_quantity; ?></h2>
                                        <p class="text-white mb-0">Jan - March 2024</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php 
        
        $result = mysqli_query($conn, "SELECT SUM(order_total) AS total_order_amount
        FROM tb_order
        WHERE order_status != 'cancelled'
        AND YEAR(order_date) = YEAR(CURRENT_DATE);        
        ");
        $row = mysqli_fetch_array($result);
        $total_order_amount = $row['total_order_amount'] ?: 0;
        ?>

                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-6">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Revenue</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">Rs.<?php echo number_format($total_order_amount,2); ?></h2>
                                        <p class="text-white mb-0">Jan - March 2024</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>


                    <?php $total_profit = $total_order_amount*0.1 ; ?>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-7">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Profit (10%)</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">Rs. <?php echo number_format($total_profit,2); ?></h2>
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