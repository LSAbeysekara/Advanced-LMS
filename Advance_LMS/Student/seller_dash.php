<?php include('config/constant.php'); ?>

<?php

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
}else{ ?>

<?php $username = $_SESSION['username']; ?> 

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
        <div class="content-body">

        <?php  if ($_SESSION['seller']=="Active"){
        
        $result = mysqli_query($conn, "SELECT COUNT(*) AS my_product FROM tb_product WHERE create_by='$username'");
        $row = mysqli_fetch_array($result);
        $my_product = $row['my_product'] ?: 0;
        ?>
            <div class="container-fluid mt-3">
                <div class="row">


                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-5">
                                <div class="card-body">
                                    <h3 class="card-title text-white">My Products</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white"><?php echo $my_product; ?></h2>
                                        <p class="text-white mb-0">As at Today</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php 
        
        $result = mysqli_query($conn, "SELECT SUM(od.quantity) AS total_selling_quantity
        FROM tb_order o
        INNER JOIN tb_order_details od ON o.order_id = od.order_id
        INNER JOIN tb_product p ON od.pro_id = p.pro_id
        INNER JOIN tb_student s ON p.create_by = s.username
        WHERE s.username = '$username' and o.order_status !='Cancelled'
        AND YEAR(o.order_date) = YEAR(CURRENT_DATE);
        ");
        $row = mysqli_fetch_array($result);
        $total_selling_quantity = $row['total_selling_quantity'] ?: 0;
        ?>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-7">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Selling Items</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white"><?php echo $total_selling_quantity; ?></h2>
                                        <p class="text-white mb-0">Jan - March 2024</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <?php 
        
        $result = mysqli_query($conn, "SELECT SUM(od.quantity * od.p_s_price) AS total_selling_amount
        FROM tb_order o
        INNER JOIN tb_order_details od ON o.order_id = od.order_id
        INNER JOIN tb_product p ON od.pro_id = p.pro_id
        INNER JOIN tb_student s ON p.create_by = s.username
        WHERE s.username = '$username' AND o.order_status != 'Cancelled'
        AND YEAR(o.order_date) = YEAR(CURRENT_DATE)");

        $row = mysqli_fetch_array($result);
        $total_order_amount = $row['total_selling_amount'] ?: 0;
        ?>

                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-6">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Revenue</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">Rs.<?php echo number_format($total_order_amount,2); ?></h2>
                                        <p class="text-white mb-0">Jan - March 2024</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>


                    <?php $total_profit = $total_order_amount-($total_order_amount*0.1 ); ?>
                    <div class="col-lg-3 col-sm-6" style="cursor: pointer;">
                        <a href="#">
                            <div class="card gradient-7">
                                <div class="card-body">
                                    <h3 class="card-title text-white">Total Recevied  (Deduct Comm. 10%)</h3>
                                    <div class="d-inline-block">
                                        <h2 class="text-white">Rs. <?php echo number_format($total_profit,2); ?></h2>
                                        <p class="text-white mb-0">Jan - March 2024</p>
                                    </div>
                                    <span class="float-right display-5 opacity-5"><i class="fa fa-heart"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
       
                </div>

                
            <!-- #/ container -->
        </div>
        
    </div>

    <?php }else if($_SESSION['seller']=="Inactive") { ?>

        <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h2 style="text-align: center;">You Need to be a seller to use this dashboard. If your not a Seller use "Became A Seller" Button to Activate seller dashboard"</h2></br></br></br></br>
                                
                                <form action="becameseller.php" method="post" >
                                <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>" />
                               <center> <button type="submit" class="btn" style="background-color:orangered; "  >Became A Seller</button></center>

                                </form>
                                </br></br></br></br>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


   <?php }else if($_SESSION['seller']=="Suspended") {?>
    <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

    <h2 style="text-align: center;">Your Seller Account Has Been <span style="color: red; font-weight: 100;">Suspended</span>. </h2></br></br></br></br>
    <h3 style="text-align: center;">Please contact System Administrator to update your account information and instructions for your business.</h3>

    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

  <?php } ?>
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
        document.addEventListener('DOMContentLoaded', function () {
            // Get references to the file input elements
            const img01Input = document.getElementById('img01');
            const img02Input = document.getElementById('img02');
            const img03Input = document.getElementById('img03');

            // Add event listener for img01 input change
            img01Input.addEventListener('change', function () {
                // Enable img02 input when img01 has a file selected
                img02Input.disabled = false;
            });

            // Add event listener for img02 input change
            img02Input.addEventListener('change', function () {
                // Enable img03 input when img02 has a file selected
                img03Input.disabled = false;
            });
        });
    </script>

    <script>
        jQuery.noConflict();

    </script>
        <script>
    function checkitemcode() {
        var itemcode = $('#itemcode').val();

        $.ajax({
            url: 'checkitem.php', // Replace with the actual URL where you check the username
            method: 'POST',
            data: { itemcode: itemcode },
            success: function(response) {
                var messageElement = $('#itemdb');

                if (response === 'exist') {
                    messageElement.text('Itemcode already exists').css('color', 'red');
                    $('#submitBtn').prop('disabled', true);
                } else {
                    messageElement.text('Available to use ').css('color', 'green');
                    $('#submitBtn').prop('disabled', false);
                }
            }
        });
    }

    jQuery(document).ready(function() {
        $('#itemcode').on('blur', function() {
            checkitemcode();
        });
    });
</script>
    <script>
        tinymce.init({
            selector: 'textarea#prodesc',
            plugins: ' autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            // ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
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