<?php
$teacher_name = isset($_COOKIE['teacher_name']) ? $_COOKIE['teacher_name'] : null;
$user_type = isset($_COOKIE['user_type']) ? $_COOKIE['user_type'] : null;
$tchr_id   = isset($_COOKIE['tchr_id']) ? $_COOKIE['tchr_id'] : null;


session_start();
$_SESSION['teacher_name'] = $teacher_name;
$_SESSION['user_type'] = $user_type;
$_SESSION['tchr_id'] = $tchr_id;
?>
<!DOCTYPE html>
<html lang="en">

<?php if (!isset($_SESSION['teacher_name'])) {
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
            <div class="nk-sidebar">
                <div class="nk-nav-scroll">
                    <ul class="metismenu" id="menu">
                        <li class="nav-label">Dashboard</li>
                        <li>
                            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">My Courses</span>
                            </a>
                            <ul aria-expanded="false">
                            <?php
                        include('config/constant.php');
                        $t_id = $_SESSION['tchr_id'];
                        $sqls = "SELECT * FROM `tb_courses` where t_id='$t_id' and c_type='lms'";

                        $resultq = $conn->query($sqls);


                        while ($rows = $resultq->fetch_assoc()) { ?>

                                <li><a href="./course.php?id=<?php echo $rows['c_id']; ?>"><?php echo $rows['c_name']; ?></a></li>
                           
                                

                            <?php } ?>
                            </ul>
                        </li>
                        </li>

                    </ul>
                </div>
            </div>
            <!--**********************************
            Sidebar end
        ***********************************-->

            <!--**********************************
            Content body start
        ***********************************-->
            <div class="content-body">
                <h3 style="margin: 15px 0 0 15px;">My courses</h3>

                <div class="container-fluid mt-3">
                    <div class="row">
                        <?php
                        // include('config/constant.php');
                        // $t_id = $_SESSION['tchr_id'];
                        $sql = "SELECT * FROM `tb_courses` where t_id='$t_id' and c_type='lms'";

                        $result = $conn->query($sql);


                        while ($row = $result->fetch_assoc()) { ?>
                            <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                                <a href="course.php?id=<?php echo $row['c_id']; ?>">
                                    <div class="card gradient-1">
                                        <div class="card-body">
                                            <h3 class="card-title text-white"><?php echo $row['c_id']; ?></h3>
                                            <div class="d-inline-block">
                                                <h2 class="text-white"><?php echo $row['c_name']; ?></h2>
                                                <p class="text-white mb-0">From: <?php echo $row['created']; ?></p>
                                            </div>
                                            <span class="float-right display-5 opacity-5"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                </a>
                            </div>

                        <?php } ?>


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