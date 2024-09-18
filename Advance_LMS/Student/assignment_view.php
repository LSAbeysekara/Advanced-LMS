<?php include('config/constant.php'); 

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
} else { ?>

<?php

if(isset($_GET['c_id']) && isset($_GET['act_id'])) {
    
    $course_id = $_GET['c_id'];
    $act_id = $_GET['act_id'];
    $username = $_SESSION['username'];
    
} else {
    header("Location: ./course_view.php?c_id=" . $c_id);
    exit(); 
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
  
    <title>Course</title>
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
        @import url('https://fonts.googleapis.com/css2?family=Madimi+One&display=swap');

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


        table.submission {
            width: 100%;
            border-collapse: collapse;
            font-family: "Madimi One", sans-serif;
            font-size: 18px;
            font-weight: 400;
            font-style: normal;
        }

        table.submission, th, td {
        border: 1px solid black;
        }

        th, td {
        padding: 8px;
        text-align: left;
        }

        th {
        background-color: #f2f2f2;
        }

        tr:nth-child(even) {
        background-color: #f2f2f2;
        }

        tr:hover {
        background-color: #ddd;
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

                                <?php
                                    $sql = "SELECT * FROM tb_courses WHERE c_id = '$course_id'";

                                    $res = mysqli_query($conn, $sql);

                                    $count = mysqli_num_rows($res);

                                    if($count>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $course_name = $row['c_name'];
                                        }
                                    }

                                ?>
                                
                                <h2 style="margin: 15px 0 0 15px;">CID2 - <?php echo $course_name; ?></h2><br>

                                <?php
                                    $sql2 = "SELECT * FROM tb_activity WHERE act_id = '$act_id'";

                                    $res2 = mysqli_query($conn, $sql2);

                                    $count2 = mysqli_num_rows($res2);

                                    if($count2>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res2))
                                        {
                                            $act_name = $row['act_name'];
                                            $file_name = $row['file_name'];
                                            $file_type = $row['file_type'];
                                            $content = $row['content'];
                                            $act_type = $row['act_type'];
                                            $deadline = $row['deadline'];
                                            $created = $row['created'];
                                            $status = $row['status'];
                                        }
                                    }

                                ?>

                                <h3 style="margin: 15px 0 0 15px;"><?php echo $act_id; ?> - <?php echo $act_name; ?></h3><br>
                                
                                <?php   
                                    date_default_timezone_set('Asia/Colombo');
                                    $currentDateTime = date("Y-m-d H:i:s");
                                ?>

                                <div style="margin: 15px 0 0 15px;">
                                    <?php
                                        echo $content; 

                                        $pdfFilePath = '../Teacher/activities/'.$file_name;
                                        $pdfFileName = basename($pdfFilePath);

                                        if (file_exists($pdfFilePath)) {
                                            ?>
                                            <a href="<?php echo $pdfFilePath; ?>" download="<?php echo $pdfFileName; ?>" style="color:red; text-decoration: underline;">
                                                <?php echo $pdfFileName; ?>
                                            </a>
                                            <?php
                                        } else {
                                            echo "<p style='color: orange;'>File not found!</p>";
                                        }
                                    ?>

                                    

                                    <?php
                                    $answer_file_name = "0";
                                    $comment = "";
                                    $sql3 = "SELECT * FROM tb_submission WHERE act_id = '$act_id' AND st_username = '$username'";

                                    $res3 = mysqli_query($conn, $sql3);

                                    $count3 = mysqli_num_rows($res3);

                                    if($count3>0)
                                    {
                                        while($row=mysqli_fetch_assoc($res3))
                                        {
                                            $answer_file_name = $row['file_name'];
                                            $grading = $row['grading'];
                                            $grading_status = $row['grading_status'];
                                            $uploaded_date = $row['uploaded_date'];
                                            $comment = $row['comment'];
                                        }
                                    }

                                    ?>

                                    <?php if($answer_file_name != "0") { ?>
                                    <br><br>
                                    <h4>Submission Status</h4><br>
                                    <table class="submission">
                                        <tr>
                                            <td>
                                                Submission Status
                                            </td>
                                            <td style="background-color: green;">
                                                Submitted
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Grading Status
                                            </td>
                                            <td>
                                                <?php 
                                                    if($grading != NULL && $grading_status=="active"){
                                                        echo $grading;
                                                    }else{
                                                        echo "Pending Grading";
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Assignment Deadline
                                            </td>
                                            <td>
                                                <?php
                                                    $timestamp = strtotime($deadline);
                                                    $formattedDate = date("l, j F Y, g:i A", $timestamp);
                                                    echo $formattedDate;
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Time Remaining
                                            </td>
                                            <td>
                                                <?php 
                                                    
                                                    $startDateTime = new DateTime($uploaded_date);
                                                    $endDateTime = new DateTime($deadline);
                                                    
                                                    // Calculate the difference
                                                    $difference = $endDateTime->diff($startDateTime);
                                                    
                                                    $days = $difference->days;
                                                    $hours = $difference->h;
                                                    $minutes = $difference->i;

                                                    // Display the time difference
                                                    echo "Assignment was submitted ";
                                                    if ($days > 0) {
                                                        echo "$days days ";
                                                    }
                                                    if ($hours > 0) {
                                                        echo "$hours hours ";
                                                    }
                                                    if ($minutes > 0) {
                                                        echo "$minutes minutes";
                                                    }
                                                    if ($days == 0 && $hours == 0 && $minutes == 0) {
                                                        echo "0 minutes";
                                                    }
                                                    echo " before";
                                                 ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Last Modified
                                            </td>
                                            <td>
                                                <?php 
                                                    $timestamp = strtotime($uploaded_date);
                                                    $formattedDate = date("l, j F Y, g:i A", $timestamp);
                                                    echo $formattedDate;
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php }else{ ?>
                                            <br><br>
                                            <h4>Deadline: </h4>
                                            <h3>
                                                <?php
                                                    $timestamp = strtotime($deadline);
                                                    $formattedDate = date("l, j F Y, g:i A", $timestamp);
                                                    echo $formattedDate;
                                                ?>
                                            </h3>
                                    <?php } ?>

                                    <br><br>
                                    <h4>Upload your answer here:</h4>

                                    <?php
                                        $pdfFilePath = '../Teacher/assignment/'.$course_id."_".$act_name."/" . $answer_file_name;
                                        $pdfFileName = basename($pdfFilePath);

                                        if (file_exists($pdfFilePath)) {
                                            ?>
                                            Your answer:
                                            <a href="<?php echo $pdfFilePath; ?>" download="<?php echo $pdfFileName; ?>" style="color:blue; text-decoration: underline; font-size: 16px;">
                                                <?php echo $pdfFileName; ?>
                                            </a>
                                            <?php
                                        } else {
                                            echo "<p style='color: #E14343; font-size: 17px;'>You haven't upload a answer yet.</p>";
                                        }
                                    ?>
                                    <br><br>

                                    <form action="upload_answer.php" method="post" enctype="multipart/form-data">
                                        <input type="file" id="file" name="file" accept=".pdf, .docx, .doc, .pptx, .pptx, .xlsx, .xls, .jpg, .jpeg, .png, .gif, .mp3, .wav, .mp4, .mov, .txt, .py, .java, .html, .css, .js, .epub, .mobi, .csv, .one" required><br><br>
                                        
                                        <input type="hidden" name="c_id" value="<?php echo $course_id; ?>">
                                        <input type="hidden" name="act_id" value="<?php echo $act_id; ?>">
                                        <input type="hidden" name="act_name" value="<?php echo $act_name; ?>">
                                        <input type="hidden" name="username" value="<?php echo $username; ?>">

                                        <input class="button" type="submit" name="submit" value="Submit" style="padding: 8px 15px;">
                                    </form>

                                    <?php if($comment != NULL){ ?>
                                        <br><br>
                                        <h4>Comment:</h4>
                                        
                                        <p style="background-color: #E3EA51; font-size: 15px; border-radius: 10px; padding: 15px;">
                                            <?php echo $comment; ?>
                                        </p>
                                    <?php } ?>
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