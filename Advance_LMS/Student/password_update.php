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

        h4 {
            text-align: center;
            margin-bottom: 22px;
            color: #333;
            font-weight: bold;
        }

        .cont {
            display: flex;
            justify-content: space-between;
        }

        .left,
        .right {
            flex: 1;
            margin-right: 10px;
        }

        .text-dark {
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            margin-top: 5px;
        }

        .submit-button,
        .cancel-button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            transition: background-color 0.3s;
        }

        .cancel-button {
            background-color: #dc3545;
            margin-left: 10px;
        }

        .submit-button:hover{
            background-color: #0056b3;
        }

        .cancel-button:hover{
            background-color: #892C09;
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
        

        $sql = "SELECT * FROM `tb_student` where username='$username'";

        $result = $conn->query($sql);


        while ($row = $result->fetch_assoc()) {

        ?>
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-xl-3" style="min-width: 80%;">
                        <div class="card">
                            <div class="card-body">
                                <form  action="#" method="post" id="passwordForm">
                                    <h2>Change password</h2><br>
                                    
                                    <h4>Old Password</h4>
                                    <div class="cont">
                                        <div class="left">  
                                            <strong style="color: red; font-size: 15px;">Old password</strong></br> <span><input type="password" name="old_password" placeholder="Enter your current password" required></span></li><br>
                                        </div>
                                    </div><br><br>

                                    <h4>New Password</h4>
                                    <div class="cont">
                                        <div class="left">  
                                            <strong style="color: red; font-size: 15px;">New password</strong></br> <span><input type="password" id="password" name="new_password" placeholder="Enter new password" required></span></li><br>
                                        </div>
                                        <div class="right">
                                            <strong style="color: red; font-size: 15px;">Confirm password</strong></br> <span><input type="password" id="cpassword" name="con_password" placeholder="Confirm password" required></span></li><br>
                                            <div id="passwordMatchMessage" style="color: red;"></div>
                                        </div>
                                    </div><br><br>

                                    <div style="text-align: center;">
                                        <button type="submit" id="submitButton" class="submit-button" name="submit">Submit</button>
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

    <script>
        document.getElementById("password").addEventListener("input", checkPasswordMatch);
        document.getElementById("cpassword").addEventListener("input", checkPasswordMatch);

        function checkPasswordMatch() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("cpassword").value;
            var messageElement = document.getElementById("passwordMatchMessage");
            var submitButton = document.getElementById("submitButton");

            if (password === confirmPassword && password !== "") {
                messageElement.textContent = "Passwords match.";
                messageElement.style.color = "green";
                submitButton.disabled = false; // Enable submit button
            } else if (password === "" && confirmPassword === "") {
                messageElement.textContent = ""; // Clear message if both fields are empty
                submitButton.disabled = false; // Enable submit button
            } else {
                messageElement.textContent = ""; // Clear message if passwords don't match
                submitButton.disabled = true; // Disable submit button
            }
        }
    </script>


    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>
<?php } ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["con_password"];


    $sql1 = "SELECT * FROM tb_student WHERE username = '$username'";
    $res1 = mysqli_query($conn, $sql1);
    
    $count1 = mysqli_num_rows($res1);

    if($count1>0)
    {
        while($row=mysqli_fetch_assoc($res1))
        {
            $pass = $row['password'];
        }
    }

    $new_pass = sha1($new_password);

    $current_password = sha1($old_password);
    
    
    if ($pass !== $current_password) {
        
        $_SESSION['update-password-error'] = "Error";
        echo "<script>window.location.href = './password_update.php';</script>";
    
    } else {
        
        $sql2 = "UPDATE `tb_student` SET `password`='$new_pass' WHERE `username`='$username'";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == true) {
            
            $_SESSION['update-password-ok'] = "OK";
            echo "<script>window.location.href = './profile.php';</script>";
            
        } else {
            
            $_SESSION['update-password-error'] = "Error";
            echo "<script>window.location.href = './index.password_update';</script>";
            
        }
    }
}

?>
