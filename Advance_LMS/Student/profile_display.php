<?php include('config/constant.php'); ?>

<?php

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
}else{ ?>

<?php $username = $_SESSION['username']; ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Student Profile</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        
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
        <?php
        
        $username = $_GET['st_username'];

        $sql = "SELECT * FROM `tb_student` where username='$username'"; // Adjust the table and column names

        $result = $conn->query($sql);


        while ($row = $result->fetch_assoc()) {

        ?>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3" src="./images/profile-pic/<?php echo $row['pro_img'] ?>" alt="" width="120px" height="120px">
                                </div>

                                <h4>Info</h4>

                                <div class="media-body">
                                    <li><strong class="text-dark mr-4">Name</strong></br> <span>
                                        <?php
                                            if($row['st_name'] == NULL){
                                                echo "Not activated yet";
                                            }else{
                                                echo $row['st_name']; 
                                            }
                                        ?>
                                    </span></li><br>
                                    <li><strong class="text-dark mr-4">Username</strong></br> <span><?php echo $row['username'] ?></span></li><br>
                                </div>
                                
                                <ul class="card-profile__info">    
                                    <li><strong class="text-dark mr-4">Email</strong></br> <span><?php echo $row['email'] ?></span></li><br>
                                    <li><strong class="text-dark mr-4">Date of Birth</strong></br> <span><?php echo $row['date_of_birth'] ?></span></li><br>
                                </ul>
                            </div>
                        </div>  
                    </div>
                    <div class="col-lg-8 col-xl-9">

                        <div class="card">
                            <div class="card-body">
                             <h3>Courses Enrolled</h3><br>

                             

                                <?php

                                $st_id = $row['st_id'];

                                $sql1 = "SELECT * FROM tb_enrollment WHERE st_id = '$st_id'";

                                $res1 = mysqli_query($conn, $sql1);

                                $count1 = mysqli_num_rows($res1);

                                if($count1>0)
                                {
                                    while($row=mysqli_fetch_assoc($res1))
                                    {
                                        $course_id = $row['course_id'];


                                        $sql2 = "SELECT * FROM tb_courses WHERE c_id = '$course_id'";

                                        $res2 = mysqli_query($conn, $sql2);

                                        $count2 = mysqli_num_rows($res2);

                                        if($count2>0)
                                        {
                                            while($row=mysqli_fetch_assoc($res2))
                                            {
                                                $c_name = $row['c_name']; ?>

                                                <a href="course_view.php?c_id=<?php echo $course_id; ?>" style="color: blue;"><?php echo $c_name; ?></a><br><br>
                                                
                                            <?php
                                            }
                                        }
                                    }
                                }
                                
                                ?>
                            
           
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container --><?php } ?>
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