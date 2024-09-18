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
    <style>
        .cont {
            display: flex;
        }

        .left,
        .right {
            flex: 1;
            margin-right: 20px;
        }

        .edit-button {
            background-color: #0F73E0;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px; 
        }

        .edit-button:hover {
            background-color: #054890;
        }

        .pass-button{
            background-color: #EC9270;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px; 
        }

        .pass-button:hover {
            background-color: #AF4720;
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
        <?php
        $username = $_GET['id'];

        $sql = "SELECT * FROM `tb_student` where username='$username'"; // Adjust the table and column names

        $result = $conn->query($sql);


        while ($row = $result->fetch_assoc()) {

            $st_id = $row['st_id'];
        ?>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-xl-3" style="min-width: 40%;">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center mb-4">
                                    <img class="mr-3" src="./images/profile-pic/<?php echo $row['pro_img'] ?>" alt="" width="120px" height="120px">
                                </div>

                                <h2>Info</h2>

                                <div class="cont">
                                    <div class="left">
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
                                    <div class="right">
                                        <div class="media-body">
                                            <li><strong class="text-dark mr-4">Address</strong></br> <span><?php echo $row['address'] ?></span></li><br>
                                        </div>
                                        
                                        <ul class="card-profile__info">    
                                            <li><strong class="text-dark mr-4">Mobile Number</strong></br> <span><?php echo $row['mobile'] ?></span></li><br>
                                            <li><strong class="text-dark mr-4">Joined Date</strong></br> <span><?php echo $row['joined_date'] ?></span></li><br>
                                            <li><strong class="text-dark mr-4">Status</strong> </br><span>
                                                <?php
                                                    if($row['nic'] == NULL){
                                                        echo "Not activated yet";
                                                    }else{ ?>
                                                        <div style="color: green;"><?php echo "Active"; ?></div> <?php
                                                    }
                                                ?>
                                            </span></li><br>
                                            <li><strong class="text-dark mr-4">Seller Account</strong> </br><span>
                                                <?php
                                                    if($row['seller'] == "inactive"){ ?>
                                                        <div style="color: red;"><?php echo "Not registered as a seller"; ?></div> <?php
                                                    }else{ ?>
                                                        <div style="color: green;"><?php echo "Activated"; ?></div> <?php
                                                    }
                                                ?>
                                            </span></li><br>
                                        </ul>
                                    </div>
                                </div>

                                <div style="text-align: left;">

                                </div>
                                
                            </div>
                        </div>  
                    </div>
                    
                    <div class="col-lg-8 col-xl-1" style="min-width: 60%;">

                        <div class="card">
                            <div class="card-body">
                             <h3>Courses Enrolled</h3>

                            <?php
                            $sql1 = "SELECT * FROM `tb_enrollment` where st_id='$st_id'";

                            $result1 = $conn->query($sql1);

                            while ($row = $result1->fetch_assoc()) { 

                                $c_id = $row['course_id'];
                                
                                
                                $sql2 = "SELECT * FROM `tb_courses` where c_id='$c_id'";

                                $result2 = $conn->query($sql2);

                                while ($row = $result2->fetch_assoc()) { 
                                ?>
                                    <br><a href="course.php?id=<?php echo $c_id; ?>"><?php echo $row['c_name']; ?></a><br>
                            <?php
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