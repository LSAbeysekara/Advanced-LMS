<?php include('config/constant.php'); ?>

<?php $username = $_SESSION['tchr_id']; ?> 
<?php
    if (!isset($_SESSION['tchr_id'])){
        echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
    } else{ ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Product</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.tiny.cloud/1/ipootvjlv9vz4p1d1x91ok27oce25gt4no6r0tddj5c98lsw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
    /* Original styles */
    .conti {
        display: flex;
        flex-wrap: wrap;
    }

    .left1,
    .right1 {
        flex: 1;
        margin-right: 30px;
    }

    .left1 img {
        width: 450px;
        height: 450px;
    }

    .location-button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }

    /* Responsive styles */
    @media (max-width: 1373px) {
        .left1 img {
            width: 100%;
            height: auto;
        }
    }

    @media (max-width: 1200px) {
        .conti {
            display: flex;
            flex-wrap: wrap;
        }

        .left1,
        .right1 {
            flex: 1;
            margin-right: 20px;
        }
    }

    @media (max-width: 768px) {
        .left1,
        .right1 {
            flex: 100%;
            margin-right: 0;
        }

        .left1 img {
            width: 100%;
            height: auto;
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

        <?php 
        if(isset($_GET['act_id'])){

            $act_id = $_GET['act_id'];


            $sql = "SELECT * FROM tb_courses WHERE c_id = '$act_id'";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $c_name = $row['c_name'];
                    $t_id = $row['t_id'];
                    $description = $row['description'];
                    $cou_img = $row['cou_img'];
                    $location = $row['location'];
                    $l_link = $row['l_link'];

                    
                    $sql1 = "SELECT * FROM tb_teacher WHERE tchr_id = '$t_id'";

                    $res1 = mysqli_query($conn, $sql1);

                    $count1 = mysqli_num_rows($res1);

                    if($count1>0)
                    {
                        while($row=mysqli_fetch_assoc($res1))
                        {
                            $name = $row['name'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                        }
                    }

                }
            } ?>


            <div class="content-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">

                                <div class="conti">
                                    <div class="left1">
                                        <div class="media align-items-center mb-4">
                                            <img class="mr-3" src="../student/rh/images/<?php echo $cou_img; ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="right1">
                                        <h2 style="color: #C45719;"><?php echo $c_name; ?></h2><br>
                                        
                                        <div class="media-body">
                                            <li><h4><strong class="text-dark mr-4"><?php echo $description; ?></strong></h4></br>
                                            <li><h4><strong style="color: #130C99;">Teacher's Name</strong></h4><h4>
                                                <span><?php echo $name; ?></span><br><br>
                                            </h4></li>
                                            <li><h4><strong style="color: #130C99;">Contact Details</strong></h4><h5>
                                                <span>Email: </span><span style="color: #DE6A37;"><?php echo $email; ?></span><br><br>
                                                <span>Mobile: </span><span style="color: #DE6A37;"><?php echo $phone; ?></span><br><br>
                                            </h5></li>
                                            <li><h4><strong style="color: #130C99;">Location and link</strong></h4><h5><span><?php echo $location; ?></span></h5></li>
                                            <?php if ($location != 'online') { ?>
                                                <h5><li><a href="<?php echo $l_link; ?>"><button class="location-button">Get location</button></a></li></h5>
                                            <?php } ?>
                                        </div><br>
                                    </div>
                                </div>
                                
                            </div>
                        </div>  
                    </div>
                </div>
                <!-- #/ container --> 
            </div>
            <?php 
        }else{
            $_SESSION['activity-view-error'] = "Error";
            header("Location: ./resource_hub.php");
        }
        ?>


        
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
    <script>
        function checkLinkValidity() {
            const urlPattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
            if (urlPattern.test(locationInput.value)) {
                linkCheckMessage.textContent = 'Looks good!';
                linkCheckMessage.style.color = 'green';
                submitButton.disabled = false; // Enable the submit button
            } else {
                linkCheckMessage.textContent = 'Please enter a valid link.';
                linkCheckMessage.style.color = 'red';
                submitButton.disabled = true; // Disable the submit button
            }
        }

        const districtSelect = document.getElementById('districtSelect');
        const locationInput = document.getElementById('locationInput');
        const linkCheckMessage = document.getElementById('link_check');
        const submitButton = document.getElementById('submit');

        districtSelect.addEventListener('change', function() {
            if (this.value === 'online') {
                locationInput.disabled = true;
                locationInput.value = '';
                linkCheckMessage.textContent = '';
                submitButton.disabled = false; // Enable the submit button
            } else {
                locationInput.disabled = false;
                checkLinkValidity();
            }
        });

        locationInput.addEventListener('input', checkLinkValidity);
    </script>


    <script>
        // Get the sentence
        const sentence = "Testing description goes here and this is testing.";

        // Set the input field value to the length of the sentence
        const charLimit = sentence.length;
        document.getElementById('charLimitedInput').setAttribute('maxlength', charLimit);

        // Update the remaining characters count
        const charRemaining = document.getElementById('charRemaining');
        charRemaining.textContent = `${charLimit} characters remaining`;

        // Add event listener to update remaining characters count dynamically
        document.getElementById('charLimitedInput').addEventListener('input', function() {
            const remaining = charLimit - this.value.length;
            charRemaining.textContent = `${remaining} characters remaining`;
        });
    </script>


    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>

<?php } ?>




        