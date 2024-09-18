

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advance LMS</title>
    <link rel="shortcut icon" href="assets/images/x-icon.png" type="image/x-icon">

    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/lightcase.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .pageheader-section {
            top: 10px;
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


    <?php include 'header.php'; ?>
    <?php


$username = $_SESSION['username']; 
 if (!isset($_SESSION['username'])) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
  } else {
  
  
    $cart =  $_SESSION['cart'];
    // $cart = "a";

    //print_r($cart);

    ?>
    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>Shop Cart</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cart Page</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->
    <div class="row">
        <div class="col-8">

            <form class="needs-validation" method="post" action="order_details_add.php">
                <div class="shop-cart padding-tb">
                    <div class="container">
                        <div class="section-wrapper">
                            <!-- <div class="row">
                        <div class="col-md-6 mb-3">
                            
                        </div>
                    </div> -->

                            <?php

                            $sql = "SELECT * FROM tb_customer WHERE username = '$username'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $cus_name = $row['cus_name'];
                                    $address = $row['address'];
                                    $zip = $row['zip'];
                                    $mobile = $row['mobile'];
                                    $email = $row['email'];
                                    $status = $row['status'];
                                }
                            }
                            ?>


                            <div class="mb-3">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $cus_name; ?>" placeholder="Enter your name" required>
                                <div class="invalid-feedback"> Valid first name is required. </div>
                            </div>
                            <div class="mb-3">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>" placeholder="Enter your address" required>
                                <div class="invalid-feedback"> Please enter your shipping address. </div>
                            </div>
                            <div class="mb-3">
                                <label for="zip">ZIP code:</label>
                                <input type="text" class="form-control" name="zip" value="<?php echo $zip; ?>" placeholder="Enter your ZIP code" required>
                            </div>
                            <div class="mb-3">
                                <label for="mobile">Mobile:</label>
                                <input type="tel" class="form-control" name="mobile" placeholder="Enter your mobile number" pattern="[0-9]{9}" value="<?php echo $mobile; ?>" placeholder="Enter your mobile number" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email: <span class="text-muted">(Optional)</span></label>
                                <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>" placeholder="you@example.com">
                                <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                            </div>

                            <hr class="mb-4">
                            <button id="payhere-payment" class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Continue to checkout</button>
            </form>
        </div>
    </div>
    </div>
    </div>


    <div class="col-4"><!-- Shop Cart Page Section start here -->
        <div class="shop-cart padding-tb">
            <div class="container">
                <div class="section-wrapper">
                    <div class="cart-top">
                        <table>
                            <thead>
                                <tr>
                                    <th class="cat-product">Product</th>
                                    <th class="cat-price">Price</th>
                                    <th class="cat-quantity">Quantity</th>
                                    <th class="cat-toprice">Total</th>
                                    <th class="cat-edit">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($cart as $key => $value) {

                                    // echo $key ." : ". $value['quantity'] . "<br>";

                                    $sqld = "SELECT * FROM tb_product where pro_id ='$key'";
                                    $result = mysqli_query($conn, $sqld);

                                    $row = mysqli_fetch_assoc($result);
                                    $rowtotal = ($row['selling_price'] * $value['quantity']);
                                ?>
                                    <tr>
                                        <td class="product-item cat-product">
                                        <div class="p-thumb">
                                        <a href="product.php?id=<?php echo $row['pro_id']?>">                                                    <?php 
                                                    $item_code = $row['item_code'];
                                                    $jpg_path = "./product_items/{$item_code}/{$item_code}-1.jpg";
                                                    $png_path = "./product_items/{$item_code}/{$item_code}-1.png";
                                                    $jpeg_path = "./product_items/{$item_code}/{$item_code}-1.jpeg";

                                                    if (file_exists($jpg_path)) {
                                                        $image_path = $jpg_path;
                                                    } elseif (file_exists($png_path)) {
                                                        $image_path = $png_path;
                                                    } elseif (file_exists($jpeg_path)) {
                                                        $image_path = $jpeg_path;
                                                    } else {
                                                        
                                                        $image_path = "./product_items/no_image.jpg"; 
                                                    }

                                                    ?>
                                                <img src="<?php echo $image_path;?>" alt="shop"></a>
                                    </div>
                                            <div class="p-content">
                                                <a href="product.php?id=<?php echo $row['pro_id'] ?>"><?php echo $row['productname'] ?></a>
                                            </div>
                                        </td>
                                        <td class="cat-price">Rs.<?php echo  number_format($row['selling_price'], 2) ?></td>
                                        <td class="cat-quantity">
                                            <div class="cart-plus-minus">
                                                <div class="dec qtybutton" onclick="decreaseQuantity(this)">-</div>
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton[]" value="<?php echo $value['quantity'] ?>">
                                                <input type="hidden" name="product_id[]" value="<?php echo $key ?>">
                                                <div class="inc qtybutton" onclick="increaseQuantity(this)">+</div>
                                            </div>
                                        </td>
                                        <td class="cat-toprice">Rs.<?php echo  number_format($rowtotal, 2) ?></td>
                                        <td class="cat-edit">
                                            <a href="deleteCart.php?id=<?php echo $key; ?>"><img src="assets/images/shop/del.png" alt="product"></a>
                                        </td>
                                    </tr>


                                <?php

                                    $total = $total +  ($row['selling_price'] * $value['quantity']);
                                }
                                $sfee = 350;
                                $_SESSION['grand_total'] = $total;
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="cart-bottom">

                        <div class="shiping-box">
                            <div class="row">

                                <div class="col-md-12 col-12">
                                    <div class="cart-overview">
                                        <h3>Cart Totals</h3>
                                        <ul class="lab-ul">
                                            <li>
                                                <span class="pull-left">Cart Subtotal</span>
                                                <p class="pull-right cart-subtotal">Rs.<?php echo number_format($total, 2) ?></p>
                                            </li>
                                            <li>
                                                <span class="pull-left">Shipping and Handling</span>
                                                <p class="pull-right">Rs.<?php echo number_format(0, 2) ?></p>
                                            </li>
                                            <li>
                                                <span class="pull-left">Order Total</span>
                                                <p class="pull-right order-total">Rs.<?php echo number_format(($total), 2) ?></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Shop Cart Page Section ending here -->


    <?php include 'footer.php'; ?>
    <!-- footer -->


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