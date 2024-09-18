<?php include('config/constant.php'); 
include ('remstock.php');?>

<?php

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
}else{ ?>

<?php $username = $_SESSION['username']; ?> 

<?php
if(isset($_GET['pro_id'])){

$pro_id = $_GET['pro_id']; 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Product</title>
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
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product</a></li>
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
                                <form class="form-valide" method="post" action="update_product.php" enctype="multipart/form-data">

                                <?php

                                $sql = "SELECT * FROM tb_product WHERE pro_id = '$pro_id'";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $item_code = $row['item_code'];
                                        $category = $row['category'];
                                        $productname = $row['productname'];
                                        $prodesc = $row['prodesc'];
                                        $cost_price = $row['cost_price'];
                                        $selling_price = $row['selling_price'];
                                        $status = $row['status'];
                                        $quantity = $row['quantity'];
                                        $pro_img = $row['pro_img'];
                                        $productId=$row['pro_id'];
                                    }
                                }

                                //get category name
                                $sql1 = "SELECT * FROM `tb_product_catogery` where procat_id = '$category'";

                                $res1 = mysqli_query($conn, $sql1);

                                $count1 = mysqli_num_rows($res1);

                                if($count1>0)
                                {
                                    while($row=mysqli_fetch_assoc($res1))
                                    {
                                        $procatdesc = $row['procatdesc'];
                                    }
                                }

                                ?>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Item Code <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="itemcode" name="itemcode" value="<?php echo $item_code; ?>" placeholder="Enter title.." required  readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Category <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select class="form-control serviceDrop" id="catogery" name="catogery" required>
                                                    <option value="<?php echo $category; ?>"><?php echo $procatdesc; ?></option>
                                                    <?php
                                                    $sql = "SELECT * FROM `tb_product_catogery` where `status` = 'Active'";
                                                    if ($qset = $conn->query($sql)) {
                                                        while ($row = $qset->fetch_assoc()) {
                                                            echo "<option value='$row[procat_id]'>$row[procatdesc]</option>";
                                                        }
                                                    } else {
                                                        echo $conn->error;
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Name <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="itemname" name="itemname" value="<?php echo $productname; ?>" placeholder="Enter title.." required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Description <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <textarea type="text" class="form-control" id="prodesc" name="prodesc" placeholder="Enter content here.." ><?php echo $prodesc; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Cost Price <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" min=0  class="form-control" id="cost_price" name="cost_price" value="<?php echo $cost_price; ?>" placeholder="Enter cost.." step="any" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Selling Price <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" min=0  class="form-control" id="selling_price" name="selling_price" value="<?php echo $selling_price; ?>" placeholder="Enter selling price.." step="any" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Quantity <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="number" min=1 class="form-control" id="qty" name="qty" value="<?php
                                                
                                                
                                                $remainingQuantity = getRemainingQuantity($productId, $conn);
                                                
                                                echo $remainingQuantity; ?>" placeholder="Enter quantity.." required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Product Images <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                            <?php
                                                $folder_path = "../shop/product_items/".$item_code."/";
                                                $file_names = array($item_code."-1", $item_code."-2", $item_code."-3");

                                                foreach ($file_names as $index => $file_name) {
                                                    $extensions = array("jpg", "jpeg", "png", "gif");
                                                    $found = false;

                                                    foreach ($extensions as $extension) {
                                                        $file_path = $folder_path . $file_name . "." . $extension;
                                                        if (file_exists($file_path)) {
                                                            $found = true;
                                                            break;
                                                        }
                                                    }

                                                    if ($found) {
                                                        $img_src = $file_path;
                                                    } else {
                                                        $img_src = "../shop/product_items/no_image.jpg";
                                                    }

                                                    // Display the image and input element
                                                    echo '<img class="mr-3" src="' . $img_src . '" alt="" width="120px" height="120px" style="margin-bottom: 5px;">';
                                                    echo '<input type="file" class="form-control" name="pro_img0' . (++$index) . '" accept="image/*"><br>';
                                                }
                                            ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Status <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <select name="status" class="form-control" required>
                                                    <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="username" value="<?php echo $username; ?>"> 


                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <!-- <input type="hidden" class="btn btn-primary" name="submit" value="submit"> -->
                                                <input type="submit" class="btn btn-primary" id="submitBtn" name="submit" value="Submit">
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

<?php

// } else {
//     $_SESSION['edit-product-load-get-error'] = "Error";
//     header('location:./listofproduct.php');
// }
// 
}
}
?>