<?php include('config/constant.php'); ?>

<?php

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
}else{ ?>

<?php $username = $_SESSION['username']; ?> 

<?php

$sql2 = "SELECT * FROM tb_student WHERE username = '$username'";

$res2 = mysqli_query($conn, $sql2);

$count2 = mysqli_num_rows($res2);

if($count2>0)
{
    while($row=mysqli_fetch_assoc($res2))
    {
        $st_id = $row['st_id'];
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />
  
    <title>Grades</title>
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
                                
                                <h3 style="margin: 15px 0 0 15px;">Grades</h3><br>

                                <table class="timeline">
    
                                <?php
                                    date_default_timezone_set('Asia/Colombo');
                                    $currentDateTime = date("Y-m-d H:i:s");

                                    $sql = "SELECT * FROM tb_enrollment WHERE st_id = '$st_id'";

                                    $res = mysqli_query($conn, $sql);
    
                                    $count = mysqli_num_rows($res);
        
                                    if($count>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $course_id = $row['course_id'];   


                                            $sql1 = "SELECT * FROM tb_courses WHERE c_id = '$course_id'";

                                            $res1 = mysqli_query($conn, $sql1);
            
                                            $count1 = mysqli_num_rows($res1);
                
                                            if($count1>0)
                                            {
                                                while($row=mysqli_fetch_assoc($res1))
                                                {
                                                    $c_name = $row['c_name']; 
                                                }
                                                ?>
                                                <tr style="margin: 15px 0 0 0;" >
                                                    <td>
                                                        <a href="./grades.php?c_id=<?php echo $course_id; ?>"><?php echo $course_id . " - " . $c_name; ?></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>

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