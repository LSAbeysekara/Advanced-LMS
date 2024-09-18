<?php $username = "cus000003"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advance LMS</title>
    <link rel="shortcut icon" href="assets/images/x-icon.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/lightcase.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        span{
            color: red;
        }
        #registrationForm{
            width: 100%;
        }

        .account-wrapper{
            max-width: none;
        }

        .cont {
            display: flex;
        }

        .left,
        .right {
            flex: 1;
            margin-right: 20px;
        }
    </style>
</head>
<body>

    <!-- preloader start here -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- preloader ending here -->


    <!-- scrollToTop start here -->
    <a href="#" class="scrollToTop"><i class="icofont-rounded-up"></i></a>
    <!-- scrollToTop ending here -->


    <!-- header section start here -->
  <?php include './header.php'; ?>

  <?php

    $sql = "SELECT * FROM `tb_customer` where username='$username'"; // Adjust the table and column names

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        //B2024000002 _pro_pic.jpeg

    ?>

        <!-- Login Section Section Starts Here -->
        <div class="login-section padding-tb section-bg">
        <div class="container">
            <div class="account-wrapper">
                
                <form class="account-form" action="update_profile.php" method="post" id="passwordForm" enctype="multipart/form-data">
                    <div class="media align-items-center mb-4">
                        <img id="previewImage" class="mr-3" src="./images/profile-pic/<?php echo $row['pro_img'] ?>" alt="" width="120px" height="120px">
                        <div class="form-group" style="text-align: left;">
                            <span>New profile picture:</span>
                        </div>
                        <input id="uploadImage" type="file" name="profile_pic" accept=".jpg, .jpeg, .png">
                    </div>
                                    
                    <div class="cont">
                        <div class="left">
                            <div class="form-group" style="text-align: left;">
                                <span>Name:</span>
                                <input type="text" placeholder="Name" name="name" value="<?php echo $row['cus_name'] ?>" required>
                            </div>
                            <div class="form-group" style="text-align: left;">
                                <span>Username:</span>
                                <input type="text" placeholder="User Name" name="username" value="<?php echo $row['username'] ?>" readonly required>
                            </div>
                            <div class="form-group" style="text-align: left;">
                                <span>Email:</span>
                                <input type="email" placeholder="Email" name="email" value="<?php echo $row['email'] ?>" required>
                            </div>
                            <div class="form-group" style="text-align: left;">
                                <span>Password:</span>
                                <input type="password" placeholder="Enter new password" name="password" id="password">
                            </div>
                        </div>
                        <div class="right">
                                <div class="form-group" style="text-align: left;">
                                    <span>Mobile:</span>
                                    <input type="text" placeholder="mobile" name="mobile" value="<?php echo $row['mobile'] ?>" required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>Address:</span>
                                    <input type="text" placeholder="Address" name="address" value="<?php echo $row['address'] ?>" required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>ZIP code:</span>
                                    <input type="text" placeholder="zip code" name="zip" value="<?php echo $row['zip'] ?>" required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>Confirm Password:</span>
                                    <input type="password" placeholder="Confirm new password" name="cpassword" id="cpassword">
                                    <div id="passwordMatchMessage" style="color: red;"></div>
                                </div>
                        </div>

                    </div>
                    <div class="cont">
                        <div class="left">
                            <div class="form-group">
                                <button style="background-color: blue;" type="submit" class="lab-btn" id="submitButton"><span>Save</span></button>
                            </div>
                        </div>
                        <div class="right" style="min-width: 100%;">
                            <div class="form-group" style="text-align: left; min-width: 100%;">
                                <a href="./cus_profile.php" ><button style="background-color: red;" type="button" class="lab-btn"><span>Cancel</span></button></a>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- Login Section Section Ends Here -->

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


    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#username').on('input', function() {
            var username = $(this).val();
            $.ajax({
                url: 'check_username.php', 
                method: 'POST',
                data: {username: username},
                success: function(data) {
                    $('#uname').html(data); 
                    checkFormValidity();
                }
            });
        });

        $('#email').on('input', function() {
            var email = $(this).val();
            $.ajax({
                url: 'check_email.php', 
                method: 'POST',
                data: {email: email},
                success: function(data) {
                    $('#mail').html(data); 
                    checkFormValidity();
                }
            });
        });

        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#confirm_password').removeClass('is-invalid');
                $('#passwordMatch').html("<span style='color: green;'>Passwords match</span>");
                checkFormValidity(); 
            } else {
                $('#confirm_password').addClass('is-invalid');
                $('#passwordMatch').html("<span style='color: red;'>Passwords do not match</span>");
                $('#registrationForm button[type="submit"]').prop('disabled', true);
            }
        });

      
        $('#registrationForm').on('submit', function(e) {
            e.preventDefault(); 
            
            $.ajax({
                url: 'register.php',
                method: 'POST',
                data: $(this).serialize(), 
                success: function(response) {
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successful!',
                        text: response
                    }).then((result) => {
                       
                        if (result.isConfirmed) {
                            window.location.href = 'http://localhost:3000/login.php';
                        }
                    });
                },
                error: function(xhr, status, error) {
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration Failed!',
                        text: xhr.responseText 
                    });
                }
            });
        });
    

        function checkFormValidity() {
            var usernameValid = $('#uname').text().includes('available');
            var emailValid = $('#mail').text().includes('available');
            var passwordMatch = $('#password').val() == $('#confirm_password').val();

            if (usernameValid && emailValid && passwordMatch) {
                $('#registrationForm button[type="submit"]').prop('disabled', false);
            } else {
                $('#registrationForm button[type="submit"]').prop('disabled', true);
            }
        }
    });
</script>


    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/swiper.min.js"></script>
    <script src="assets/js/progress.js"></script>
    <script src="assets/js/lightcase.js"></script>
    <script src="assets/js/counter-up.js"></script>
    <script src="assets/js/isotope.pkgd.js"></script>
    <script src="assets/js/functions.js"></script>
</body>
</html>