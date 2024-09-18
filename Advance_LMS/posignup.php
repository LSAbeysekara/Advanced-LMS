<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advance LMS</title>
    <link rel="shortcut icon" href="assets/images/x-icon.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="./shop/assets/css/animate.css">
    <link rel="stylesheet" href="./shop/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./shop/assets/css/icofont.min.css">
    <link rel="stylesheet" href="./shop/assets/css/swiper.min.css">
    <link rel="stylesheet" href="./shop/assets/css/lightcase.css">
    <link rel="stylesheet" href="./shop/assets/css/style.css">
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
  <?php include './shop/header.php'; ?>

    <!-- Page  section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>Register Now</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">SIGN UP</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    <!-- Login Section Section Starts Here -->
    <div class="login-section padding-tb section-bg">
    <div class="container">
        <div class="account-wrapper">
            <h3 class="title">Register Property Owner Now</h3>
            <form class="account-form" id="registrationForm">
                <div class="form-group">
                    <input type="text" placeholder="Name" name="name" required>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="User Name" name="username" id="username" required>
                    <span id="uname"></span> 
                </div>
                <div class="form-group">
                    <input type="email" placeholder="Email" name="email" id="email" required>
                    <span id="mail"></span> 
                </div>
                    <div class="form-group">
                        <input type="text" placeholder="mobile" name="mobile" required>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="Address" name="address" required>
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="zip code" name="zip" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="confirm_password" placeholder="Confirm Password" name="cpassword" required>
                        <span id="passwordMatch"></span>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="lab-btn"><span>Get Started Now</span></button>
                </div>
                </form>
                <div class="account-bottom">
                    <span class="d-block cate pt-10">Are you a member? <a href="http://localhost:3000/login.php">Login</a></span>
                                   
                </div>
            </div>
        </div>
    </div>
    <!-- Login Section Section Ends Here -->


    <?php include './shop/footer.php'; ?>
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
                url: 'poregister.php',
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


    <script src="./shop/assets/js/jquery.js"></script>
    <script src="./shop/assets/js/bootstrap.min.js"></script>
    <script src="./shop/assets/js/swiper.min.js"></script>
    <script src="./shop/assets/js/progress.js"></script>
    <script src="./shop/assets/js/lightcase.js"></script>
    <script src="./shop/assets/js/counter-up.js"></script>
    <script src="./shop/assets/js/isotope.pkgd.js"></script>
    <script src="./shop/assets/js/functions.js"></script>
</body>
</html>