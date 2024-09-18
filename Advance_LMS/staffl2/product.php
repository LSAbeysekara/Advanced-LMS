<?php include('config/constant.php');
include ('remstock.php');
if (isset($_GET['id'])) {

    $pro_id = $_GET['id'];


    $sql = "SELECT *,c.procatdesc, p.status FROM tb_product p join tb_product_catogery c on c.procat_id=p.category WHERE pro_id = '$pro_id'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);
} ?>
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

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./index.php">Product</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">View Product</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->


            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="form-valide" method="post" action="save_product.php" enctype="multipart/form-data">

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Item images <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <?php
                                                $item_code = $row['item_code'];
                                                $jpg_path = "../shop/product_items/{$item_code}/{$item_code}-1.jpg";
                                                $png_path = "../shop/product_items/{$item_code}/{$item_code}-1.png";
                                                $jpeg_path = "../shop/product_items/{$item_code}/{$item_code}-1.jpeg";

                                                if (file_exists($jpg_path)) {
                                                    $image_path = $jpg_path;
                                                } elseif (file_exists($png_path)) {
                                                    $image_path = $png_path;
                                                } elseif (file_exists($jpeg_path)) {
                                                    $image_path = $jpeg_path;
                                                } else {
                                                    $image_path = "../shop/product_items/no_image.jpg";
                                                } ?>

                                                <img src="<?php echo $image_path; ?>" alt="Product Image" style="width: 100px; height: 100px;">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Item Code <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="itemcode" name="itemcode" value="<?php echo $row['item_code']; ?>" readonly></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Category <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="itemcode" name="itemcode" value="<?php echo $row['procatdesc']; ?>" readonly></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Name <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="itemname" name="itemname" value="<?php echo $row['productname']; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Description <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <textarea type="text" class="form-control" id="prodesc" name="prodesc" value="<?php echo $row['prodesc']; ?>"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Cost Price <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" class="form-control" id="cost_price" name="cost_price" value="<?php echo $row['cost_price']; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Selling Price <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" class="form-control" id="selling_price" name="selling_price" value="<?php
                                                
                                                
                                                
                                                echo $row['selling_price']; ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Rem.Quantity <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" class="form-control" id="qty" name="qty" value="<?php 
                                                $productId=$row['pro_id'];
                                                $remainingQuantity = getRemainingQuantity($productId, $conn);
                                                
                                                echo $remainingQuantity; ?>" readonly>
                                            </div>
                                        </div>
  







                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">


                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
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
        jQuery.noConflict();
    </script>
    <script>
        function checkitemcode() {
            var itemcode = $('#itemcode').val();

            $.ajax({
                url: 'checkitem.php', // Replace with the actual URL where you check the username
                method: 'POST',
                data: {
                    itemcode: itemcode
                },
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


    <script>
        jQuery(document).ready(function($) {
            $('.form-valide').submit(function(e) {
                e.preventDefault();
                if (tinymce.get('prodesc').getContent().trim() === '') {
                    // If content is empty, display an error message
                    Swal.fire({
                        title: 'Error!',
                        text: 'Content cannot be empty.',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return; // Exit function
                }
                var formData = new FormData(this); // Use FormData to handle file uploads

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Use form action attribute as URL
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Set contentType to false when using FormData
                    processData: false, // Set processData to false when using FormData
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                location.reload(); // Reload page after successful submission
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Server error. Please try again later.',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
        });
    </script>


    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>