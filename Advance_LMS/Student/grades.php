<?php include('config/constant.php'); 
?>
<?php
if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
} else {

if(isset($_GET['c_id'])){
    $course_id = $_GET['c_id'];
} else {
    header("Location: ./grade_courses.php");
    exit(); 
}

$sql = "SELECT * FROM tb_courses WHERE c_id = '$course_id'";

$res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res);

if($count>0)
{
    while($row=mysqli_fetch_assoc($res))
    {
        $c_name = $row['c_name']; 
    }
}

$st_username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    <title><?php echo $course_id." - ".$c_name; ?></title>
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
            width: 95%;
            margin: 10px;
            border-collapse: collapse;
        }

        table.timeline th{
            font-size: 22px;
        }

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
                                
                                <h2 style="margin: 15px 0 0 15px;">Grades</h2><br>

                                <table class="timeline">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>Assignment Name</th>
                                            <th>Grade</th>
                                            <th>Comment(s)</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php   
                                        date_default_timezone_set('Asia/Colombo');
                                        $currentDateTime = date("Y-m-d H:i:s");

                                        $grading = " ";
                                        $comment = " ";
                                        $grading_status = " ";
                                        
                                        $sql4 = "SELECT * FROM tb_activity WHERE c_id = '$course_id' AND deadline > '$currentDateTime'";
                                        $res4 = mysqli_query($conn, $sql4);

                                        $count4 = mysqli_num_rows($res4);

                                        if($count4>0){
                                        ?>

                                            <div>
                                            <?php
                                                
                                                $sql1 = "SELECT * FROM tb_activity WHERE c_id = '$course_id' ORDER BY deadline";

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
                                                        $act_status = $row['status']; 
                                                        
                                                        
                                                        $sql2 = "SELECT * FROM tb_submission WHERE act_id = '$act_id' AND st_username = '$st_username'";

                                                        $res2 = mysqli_query($conn, $sql2);

                                                        $count2 = mysqli_num_rows($res2);

                                                        if($count2>0)
                                                        {
                                                            while($row=mysqli_fetch_assoc($res2))
                                                            {
                                                                $grading = $row['grading'];
                                                                $comment = $row['comment'];
                                                                $grading_status = $row['grading_status'];
                                                            }
                                                        }
                                                        ?>

                                                                                                            
                                                        <tr>
                                                            <td style="width: 45%; height: 40px;">
                                                                <?php echo $act_name; ?>
                                                            </td>
                                                            <?php if($grading_status == 'active') { ?>
                                                                <td style="width: 15%; height: 40px;">
                                                                    <?php echo $grading; ?>
                                                                </td>
                                                                <td style="width: 15%; height: 40px;">
                                                                    <?php echo $comment; ?>
                                                                </td>
                                                            <?php }else{ ?>
                                                                <td style="width: 15%; height: 40px;">
                                                                    
                                                                </td>
                                                                <td style="width: 15%; height: 40px;">
                                                                    
                                                                </td>
                                                            <?php } ?>
                                                        </tr>
                                                    <?php

                                                    $grading = " ";
                                                    $comment = " ";
                                                    $grading_status = " ";


                                                    }
                                                } ?>
                                            </div>
                                            <?php
                                        ?><br><br>
                                        <?php } ?>
                                        </tbody>
                                    </table>
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