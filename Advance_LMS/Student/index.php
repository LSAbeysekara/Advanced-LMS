<?php include('config/constant.php'); ?>

<?php

$username   = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;


$sqld = "SELECT * FROM tb_student WHERE username = '$username'";

$resd = mysqli_query($conn, $sqld);

$rows = mysqli_fetch_assoc($resd);




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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <!-- put if and check is there a notice or not then display-->
                                <h3 style="margin: 15px 0 0 15px;">Notices</h3><br><br><br>
                                <?php

                                date_default_timezone_set('Asia/Colombo');
                                $currentDateTime = date('Y-m-d H:i:s');

                                $sql5 = "SELECT * FROM tb_notice WHERE notice_type = 'all' AND end_date > '$currentDateTime' AND status = 'active'";

                                $res5 = mysqli_query($conn, $sql5);

                                $count5 = mysqli_num_rows($res5);
    
                                if($count5>0)
                                {
                                    while($row=mysqli_fetch_assoc($res5))
                                    {
                                        $title = $row['title'];
                                        $content = $row['content']; ?>

                                        <div class="notice" style="margin: 15px 0 0 15px; padding: 10px; background-color: #F9F5F4; border-radius: 10px;">
                                            <h3><?php echo $title; ?></h3>
                                            <p><?php echo $content; ?></p>
                                        </div><br>
                                    <?php   
                                    } 
                                }else{ ?>
                                    <br><br><br>
                                <?php
                                }
                                ?>

                                <h3 style="margin: 15px 0 0 15px;">Timeline</h3><br>
                                
                                    
                                <?php
                                $st_id=$_SESSION['st_id'];

                                        $saveformat = "date";
                                        $sql = "SELECT * FROM tb_enrollment WHERE st_id = '$st_id'";

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
                                    $sql3 = "SELECT * FROM tb_enrollment WHERE st_id = '$st_id'";

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