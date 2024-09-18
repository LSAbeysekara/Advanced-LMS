<?php include('config/constant.php'); 

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
} else { ?>


<?php
    $username = $_SESSION['username'];
    $st_id = $_SESSION['st_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Student Profile</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
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

        .media.align-items-center {
            display: flex;
            justify-content: center;
        }

        .submit-button, .cancel-button {
            background-color: #007bff; 
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .cancel-button {
            background-color: #6c757d;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }

        .cancel-button:hover {
            background-color: #CB6A60;
        }

        .submit-button:focus, .cancel-button:focus {
            outline: none; 
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
        

        $sql = "SELECT * FROM `tb_student` where username='$username'"; // Adjust the table and column names

        $result = $conn->query($sql);


        while ($row = $result->fetch_assoc()) {

        ?>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-xl-3" style="min-width: 80%;">
                        <div class="card">
                            <div class="card-body">
                                <form id="imageUploadForm" action="update_profile.php" method="post" enctype="multipart/form-data">
                                    <h2>Edit Profile</h2><br>
                                    <div class="media align-items-center mb-4">
                                        <img id="previewImage" class="mr-3" src="./images/profile-pic/<?php echo $row['pro_img'] ?>" alt="" width="120px" height="120px">
                                        <input id="uploadImage" type="file" name="profile_pic" accept=".jpg, .jpeg, .png">
                                    </div>
                                                                    

                                    <div class="cont">
                                        <div class="left">
                                            <div class="media-body">
                                                <li><strong class="text-dark mr-4">Name</strong></br> <span><input type="text" name="name" placeholder="Enter your full name" value="<?php echo $row['st_name']; ?>" required></span></li><br>
                                                <li><strong class="text-dark mr-4">Username</strong></br> <span><?php echo $row['username'] ?></span></li><br>
                                            </div>
                                            
                                            <ul class="card-profile__info">    
                                                <li><strong class="text-dark mr-4">Email</strong></br> <span><?php echo $row['email'] ?></span></li><br>
                                                <li><strong class="text-dark mr-4">Date of Birth</strong></br> <span><input type="date" name="dob" value="<?php echo $row['date_of_birth']; ?>" required></span></li><br>
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
                                                <li><strong class="text-dark mr-4">Address</strong></br> <span><textarea name="address" placeholder="Enter your address" required><?php echo $row['address']; ?></textarea></span></li><br>
                                            </div>
                                            
                                            <ul class="card-profile__info">    
                                                <li><strong class="text-dark mr-4">Mobile Number</strong></br> <span><input type="text" id="mobile" name="mobile" placeholder="Enter your mobile number" pattern="[0-9]{9}{10}" title="Please enter a 10-digit mobile number" value="<?php echo $row['mobile']; ?>" required></span></li><br>
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

                                    <input type="hidden" name="username" value="<?php echo $username; ?> ">
                                
                                    <div style="text-align: center;">
                                        <button type="submit" class="submit-button" name="submit">Submit</button>
                                        <a href="./profile.php"><button class="cancel-button" name="cancel">Cancel</button></a>
                                    </div>

                                </form>
                                
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
    <script>
        document.getElementById("uploadImage").addEventListener("change", function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById("previewImage").src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

    </script>

</body>

</html>

<?php } ?>