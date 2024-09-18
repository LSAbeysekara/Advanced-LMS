<?php include('config/constant.php'); ?>

<?php

$username   = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;


$sqld = "SELECT * FROM tb_student WHERE username = '$username'";

$resd = mysqli_query($conn, $sqld);

$rows = mysqli_fetch_assoc($resd);



session_start();
$_SESSION['student_name'] = $rows['st_name'];
$_SESSION['status'] = $rows['status'];
$_SESSION['username'] = $username;
$_SESSION['st_id'] = $rows['st_id'];
$_SESSION['seller'] = $rows['seller'];
if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
} else {

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    <title>Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">
    <!-- Pignose Calender -->
    <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>

        table.timeline {
            width: 80%;
            margin: 10px;
            border-collapse: collapse;
        }

        table.timeline th,
        table.timeline td {
            padding: 2px;
            font-size: 17px;
            font-weight: 400;
        }

        table.timeline th {
            background-color: #f2f2f2;
            text-align: left;
        }

        table.timeline tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #000;
            text-decoration: none;
        }

        a:hover {
            color: #333;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50; /* Green */
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            }

            /* Hover effect */
            .button:hover {
            background-color: #45a049; /* Darker green */
            }

            /* Active/focus state */
            .button:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.2); /* Add a border around the button when focused */
            }

            /* Disable the button styles for printing */
            @media print {
            .button {
                display: none;
            }
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
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="index.php">
                    <b class="logo-abbr"><img src="images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="./images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <img src="images/logo-text.png" alt="">
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge badge-pill gradient-1">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">3 New Messages</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-1">3</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/1.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Saiful Islam</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/2.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Adam Smith</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Can you do me a favour?</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/3.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Barak Obama</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="images/avatar/4.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Hilari Clinton</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hello</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">5</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Started</h6>
                                                    <span class="notification-text">One hour ago</span> 
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Event Ended Successfully</h6>
                                                    <span class="notification-text">One hour ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events to Join</h6>
                                                    <span class="notification-text">After two days</span> 
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="images/profile-pic/default.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="profile.php"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <i class="icon-envelope-open"></i> <span>Inbox</span> <div class="badge gradient-3 badge-pill gradient-1">3</div>
                                            </a>
                                        </li>
                                        
                                        <hr class="my-2">
                                        <li>
                                            <a href="page-lock.php"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                                        </li>
                                        <li><a href="page-login.php"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="javascript:void()" aria-expanded="false">
                            <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-home menu-icon"></i></i><span class="nav-text">My courses</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="./course_view.php?c_id=CID2">enrolled course 01</a></li>
                            <li><a href="./course_view.php?c_id=CID3">enrolled course 02</a></li>
                        </ul>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <!-- put if and check is there a notice or not then display-->
                                <h3 style="margin: 15px 0 0 15px;">Notices</h3><br><br><br>


                                <h3 style="margin: 15px 0 0 15px;">Timeline</h3><br>
                                
                                    
                                <?php

                                        $saveformat = "date";
                                        $sql = "SELECT * FROM tb_enrollment WHERE st_id = '1'";

                                        $res = mysqli_query($conn, $sql);
        
                                        $count = mysqli_num_rows($res);
            
                                        if($count>0)
                                        {
                                            while($row=mysqli_fetch_assoc($res))
                                            {
                                                $course_id = $row['course_id'];
                                                $course_status = $row['status'];

                                                $sql2 = "SELECT * FROM tb_courses WHERE c_id = '$course_id'";

                                                $res2 = mysqli_query($conn, $sql2);
                
                                                $count2 = mysqli_num_rows($res2);
                    
                                                if($count2>0)
                                                {
                                                    while($row=mysqli_fetch_assoc($res2))
                                                    {
                                                        $course_name = $row['c_name'];
                                                    }
                                                }

                                                date_default_timezone_set('Asia/Colombo');
                                                $currentDateTime = date("Y-m-d H:i:s");

                                                $sql1 = "SELECT * FROM tb_activity WHERE c_id = '$course_id' AND deadline > '$currentDateTime' ORDER BY deadline";

                                                $res1 = mysqli_query($conn, $sql1);
                
                                                $count1 = mysqli_num_rows($res1);
                    
                                                if($count1>0)
                                                {
                                                    while($row=mysqli_fetch_assoc($res1))
                                                    {
                                                        $act_id = $row['act_id'];
                                                        $act_name = $row['act_name'];
                                                        $file_name = $row['file_name'];
                                                        $act_type = $row['act_type'];
                                                        $deadline = $row['deadline'];
                                                        $act_status = $row['status']; ?>
                                                            
                                                        <h5 style="margin: 3px 0 0 16px;">
                                                            <?php
                                                                $timestamp = strtotime($deadline);
                                                                $formatted_deadline = date('l, jS \of F Y', $timestamp);

                                                                if ($saveformat != $formatted_deadline) {
                                                                    echo $formatted_deadline;
                                                                    $saveformat = $formatted_deadline;
                                                                }
                                                            ?>
                                                        </h5>

                                                        <table class="timeline"> 
                                                            <tbody>                                                        
                                                                <tr>
                                                                    <td style="width: 5%; height: 40px;">
                                                                        <?php
                                                                            $timestamp = strtotime($deadline);
                                                                            echo $formatted_time = date('H:i', $timestamp);
                                                                        ?>
                                                                    </td>
                                                                    <td style="width: 10%; height: 40px;">
                                                                        <?php
                                                                            $imageSource = "./images/assignment.png";
                                                                            echo "<img src='$imageSource' style='width: 60px; height: 30px; padding-left:10px;' alt='Image'>";
                                                                        ?>
                                                                    </td>
                                                                    <td style="width: 68%; height: 40px;">
                                                                        <?php echo $course_name." - ".$act_name; ?>
                                                                    </td>
                                                                    <td style="width: 15%; height: 40px;">
                                                                        <a class="button" href="./assignment_view.php?c_id=<?php echo $course_id; ?>&act_id=<?php echo $act_id; ?>">View</a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    <?php
                                                    }
                                                }
            
                                            }
                                        }
                                        ?><br><br>

                                <h3 style="margin: 15px 0 0 15px;">Recently accessed courses</h3>

                                <div class="container-fluid mt-3">
                                    <div class="row">

                                    <?php 
                                    $sql3 = "SELECT * FROM tb_enrollment WHERE st_id = '1'";

                                    $res3 = mysqli_query($conn, $sql3);

                                    $count3 = mysqli_num_rows($res3);

                                    if($count3>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res3))
                                        {
                                            $course_id = $row['course_id'];   
                                        

                                            $sql4 = "SELECT * FROM tb_courses WHERE status = 'active' AND c_id = '$course_id' LIMIT 3";

                                            $res4 = mysqli_query($conn, $sql4);

                                            $count4 = mysqli_num_rows($res4);

                                            if($count4>0)
                                            {
                                                while($row=mysqli_fetch_assoc($res4))
                                                {
                                                    $c_name = $row['c_name'];
                                                }
                                            } ?>

                                            <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                                                <a href="./course_view.php?c_id=<?php echo $course_id; ?>">
                                                    <div class="card gradient-1">
                                                        <div class="card-body">
                                                            <?php
                                                                $imageSource = "./images/assignment.png";
                                                                echo "<img src='$imageSource' style='width: 100%; height: 100%; padding: 0;' alt='Image'>"; ?>
                                                                <br><br>
                                                                <h4> <?php echo $c_name; ?></h4> 
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </div>
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
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>


    <script src="./js/dashboard/dashboard-1.js"></script>

</body>

</html>
<?php } ?>