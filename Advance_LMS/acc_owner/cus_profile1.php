

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advance LMS</title>
    <link rel="shortcut icon" href="assets/images/x-icon.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js" defer></script>

    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/lightcase.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        span {
            color: red;
        }

        #registrationForm {
            width: 100%;
        }

        .account-wrapper {
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

$username   = isset($_COOKIE['cus_name']) ? $_COOKIE['cus_name'] : null;


$sqld = "SELECT * FROM tb_customer WHERE username = '$username'";

$resd = mysqli_query($conn, $sqld);

$rows = mysqli_fetch_assoc($resd);




$_SESSION['name'] = $rows['cus_name'];
$_SESSION['status'] = $rows['status'];
$_SESSION['username'] = $username;
$_SESSION['id'] = $rows['id'];

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else {

    ?>



    <?php
    $username = $_SESSION['username']; 
    $sql = "SELECT * FROM `tb_customer` where username='$username'"; // Adjust the table and column names

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {

    ?>

        <!-- Login Section Section Starts Here -->
        <div class="login-section padding-tb section-bg">
            <div class="container">
                <div class="account-wrapper">
                    <div class="media align-items-center mb-4">
                        <img class="mr-3" src="./images/profile-pic/<?php echo $row['pro_img'] ?>" alt="" width="120px" height="120px">
                    </div>

                    <form class="account-form" action="edit_profile.php" method="post" enctype="multipart/form-data">
                        <div class="cont">
                            <div class="left">
                                <div class="form-group" style="text-align: left;">
                                    <span>Name:</span>
                                    <input type="text" placeholder="Name" name="name" value="<?php echo $row['cus_name'] ?>" readonly required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>Username:</span>
                                    <input type="text" placeholder="User Name" name="username" value="<?php echo $row['username'] ?>" readonly required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>Email:</span>
                                    <input type="email" placeholder="Email" name="email" value="<?php echo $row['email'] ?>" readonly required>
                                </div>
                            </div>
                            <div class="right">
                                <div class="form-group" style="text-align: left;">
                                    <span>Mobile:</span>
                                    <input type="text" placeholder="mobile" name="mobile" value="<?php echo $row['mobile'] ?>" readonly required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>Address:</span>
                                    <input type="text" placeholder="Address" name="address" value="<?php echo $row['address'] ?>" readonly required>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                    <span>ZIP code:</span>
                                    <input type="text" placeholder="zip code" name="zip" value="<?php echo $row['zip'] ?>" readonly required>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit" class="lab-btn"><span>Edit Profile</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="login-section section-bg" style="padding-bottom: 50px;">
        <div class="container">
            <div class="account-wrapper">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Orders History</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered " id="orderTable">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Order Date</th>
                                                <th>Order ID</th>
                                                <th>Product Name</th>
                                                <th>Qty</th>
                                                <th>Item Price</th>
                                                <th>Order Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Login Section Section Ends Here -->


    <?php include 'footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#username').on('input', function() {
                var username = $(this).val();
                $.ajax({
                    url: 'check_username.php',
                    method: 'POST',
                    data: {
                        username: username
                    },
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
                    data: {
                        email: email
                    },
                    success: function(data) {
                        $('#mail').html(data);
                        checkFormValidity();
                    }
                });
            });

            $('#password, #confirm_password').on('keyup', function() {
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
    <script>
        $(document).ready(function() {
            var usernames = 'cus000003';
            var table = $('#orderTable').DataTable({
                "ajax": {
                    "url": "orderdata.php",
                    "data": function(d) {
                        d.username = usernames; // Include username in the request data
                    },
                    "dataType": "json",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "product_img",
                        "render": function(data) {
                            return '<img src="' + data + '" alt="Product Image" style="width: 75px; height: 75px;">';
                        }
                    },
                    {
                        "data": "order_date"
                    },
                    {
                        "data": "order_id"
                    },
                    {
                        "data": "product_name"
                    },
                    {
                        "data": "quantity"
                    },
                    {
                        "data": "item_price"
                    },
                    {
                        "data": "order_status"
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            var actionButtons = '';

                            if (row.order_status === 'order placed') {
                                actionButtons += '<button class="cancel-btn btn btn-danger" data-order-id="' + row.order_id + '">Cancel Order</button>';
                            } else if (row.order_status === 'Processing' || row.order_status === 'Hand over to Uber' || row.order_status === 'Hand over to Pick Me') {
                                actionButtons += '<button class="deliver-btn btn btn-success" data-order-id="' + row.order_id + '">Delivered</button> ';
                            }

                            actionButtons += ' <button class="view-btn btn btn-info" data-order-id="' + row.order_id + '">View</button>';

                            return actionButtons;
                        }
                    }
                ]
            });

            // Handle click on view button
            $('#orderTable').on('click', '.view-btn', function() {
                var orderId = $(this).data('order-id');
                // Redirect to view order page
                window.location.href = 'view_order.php?id=' + orderId;
            });

            $('#orderTable').on('click', '.cancel-btn', function() {
                var orderId = $(this).data('order-id');

                // Ask for confirmation using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to cancel this order.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {

                    if (result.isConfirmed) {

                        window.location.href = 'cancel_order.php?order_id=' + orderId;

                        // Show success message after cancellation
                        Swal.fire(
                            'Cancelled!',
                            'Your order has been cancelled.',
                            'success'
                        );
                    }
                });
            });


            // Handle click on deliver button
            $('#orderTable').on('click', '.deliver-btn', function() {
                var orderId = $(this).data('order-id');

                // Ask for confirmation using SweetAlert
                Swal.fire({
                    title: 'Confirm Delivery',
                    text: 'Are you sure you want to mark this order as delivered?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, mark it as delivered!'
                }).then((result) => {
                    // If user confirms, perform delivery action
                    if (result.isConfirmed) {

                        window.location.href = 'deliver_order.php?order_id=' + orderId;
                        // Show success message after delivery
                        Swal.fire(
                            'Delivered!',
                            'The order has been marked as delivered.',
                            'success'
                        );
                    }
                });
            });

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
<?php } ?>