<?php include('config/constant.php'); ?>
<?php
session_start(); 


 if (!isset($_SESSION['teacher_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/t_login'); </script>";
  } else {
  
    ?>
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
        
        $t_username = "TCH000003";

        $sql = "SELECT * FROM `tb_teacher` where username='$t_username'"; // Adjust the table and column names

        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {

        ?>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="media align-items-center mb-4" style="margin: 15px 0 0 45%">
                                <img class="mr-3" src="./images/profile-pic/<?php echo $row['pro_img'] ?>" alt="" width="120px" height="120px">
                            </div>
                            <div style="text-align: center;">
                                <h3><?php echo $row['name']; ?></h3>
                                <h5><?php echo $row['username']; ?></h5>
                            </div>
                            <div class="form-validation" style="padding-left:3%;">
                                <form class="form-valide" action="update-profile.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Name: </label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Password: </label>
                                        <div class="col-lg-6">
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Confirm Password: </label>
                                        <div class="col-lg-6">
                                            <input type="password" class="form-control" id="c_password" name="c_password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Address: </label>
                                        <div class="col-lg-6">
                                            <textarea name="address" class="form-control" cols="30" rows="4"><?php echo $row['address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Profile Picture: </label>
                                        <div class="col-lg-6">
                                            <input type="file" name="pro-pic">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Phone: </label>
                                        <div class="col-lg-6">
                                            <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" value="<?php echo $row['phone']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label">Status: </label>
                                        <div class="col-lg-6">
                                            <select name="status" class="form-control" required>
                                                <option value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></option>
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="t_id" value="T15">

                                    <div class="form-group row">
                                        <div class="col-lg-8 ml-auto">
                                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                        </div>
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

</body>

</html>
<?php } ?>