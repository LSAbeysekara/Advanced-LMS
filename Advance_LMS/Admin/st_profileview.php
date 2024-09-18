<?php include('config/constant.php'); ?>

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
        
        $username = $_GET['id'];

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
                                    <li><strong class="text-dark mr-4">NIC</strong> </br><span>
                                        <?php
                                            if($row['nic'] == NULL){
                                                echo "Not activated yet";
                                            }else{
                                                echo $row['nic']; 
                                            }
                                        ?>
                                    </span></li><br>

                                </ul>
                            </div>
                        </div>  
                    </div>
                    <div class="col-lg-8 col-xl-9">

                        <div class="card">
                            <div class="card-body">
                             <h3>Courses Enrolled</h3>
           
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