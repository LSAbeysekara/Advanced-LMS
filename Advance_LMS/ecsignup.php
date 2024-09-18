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
            <h3 class="title">Became a Extracurricular Teacher </h3>
            <form class="account-form" id="registrationForm">
                <div class="form-group">
                    <input type="text" placeholder="Name" name="name" required>
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
                        <input type="text" id="nic" placeholder="Nic Number here" name="nic" required>
                    </div>
                    <div class="form-group">
                    <label class="col-lg-4 col-form-label" for="val-cv">CV <span class="text-danger">*</span>
                                            </label>
                                           
                                                <input type="file" class="form-control" id="val-cv" name="val-cv" placeholder="">
                                           
                    </div>
                    <div class="form-group">
                    <label class="col-lg-4 col-form-label" for="val-certificate">Cetificate <span class="text-danger">*</span>
                                            </label>
                                           
                                                <input type="file" class="form-control" id="val-certificate" name="val-certificate" placeholder="5">
                                            
                    </div>
                    
                    <div class="form-group">
                    <button type="submit" class="lab-btn"><span>Apply Now</span></button>
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


        $('#email').on('input', function() {
            var email = $(this).val();
            $.ajax({
                url: 'check_email_tea.php', 
                method: 'POST',
                data: {email: email},
                success: function(data) {
                    $('#mail').html(data); 
                    checkFormValidity();
                }
            });
        });


      
        $('#registrationForm').on('submit', function(e) {
            e.preventDefault(); 
            var formData = new FormData(this);
            $.ajax({
                url: 'ecteacherreg.php',
                method: 'POST',
                data: formData, 
                processData: false, 
                contentType: false, 
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
          
            var emailValid = $('#mail').text().includes('available');
        
            if (emailValid) {
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