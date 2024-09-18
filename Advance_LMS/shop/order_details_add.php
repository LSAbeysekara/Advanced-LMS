

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
        .pageheader-section{
            top: 10px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 3% 5%;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            font-size: 20px;
        }

        button:hover {
            background-color: #0056b3;
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

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $address = $_POST['address'];
    $zip = $_POST['zip'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email']; ?>

    <!--------------- database details ------------------------------->
    <?php
        
        $items = "testing order";

    ?>
    

<?php $username = $_SESSION['cus_id'];?>
    <?php
$grand_total=$_SESSION['grand_total'];
    $cart =  $_SESSION['cart'];
    //$cart = "a";

    //print_r($cart);

    ?>
    


    <div class="row">
        <div class="col-4"> 
            <div class="shop-cart padding-tb">
                <div class="container">
                    <div class="section-wrapper">
                        <div class="cart-bottom">

                            <div class="shiping-box">
                                <div class="row">

                                    <div class="col-md-12 col-12">
                                        <div class="cart-overview">
                                            <h3>Shipping address:</h3>
                                            <div>
                                                <h5><?php echo $name; ?></h5>
                                                <h7><?php echo $address; ?></h7><br>
                                                <h7><?php echo $zip; ?></h7><br>
                                                <h7><?php echo $mobile; ?></h7><br>
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

        <div class="col-4" ><!-- Shop Cart Page Section start here -->
            <div class="shop-cart padding-tb">
                <div class="container">
                    <div class="section-wrapper">
                        <div class="cart-bottom">

                            <div class="shiping-box">
                                <div class="row">

                                    <div class="col-md-12 col-12">
                                        <div class="cart-overview">
                                            <h3>Cart Totals</h3>
                                            <h4><?php echo $grand_total; ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-4" ><!-- Shop Cart Page Section start here -->
            <div class="shop-cart padding-tb">
                <div class="container">
                    <div class="section-wrapper">
                        <div class="cart-bottom">

                            <div class="shiping-box">
                                <div class="row">

                                    <div class="col-md-12 col-12">
                                        <div class="cart-overview">
                                            <div class="hw" style="display: flex; height: 50vh;">
                                                <div class="hw" style="width: 48%; text-align: center; margin-right: 3%;">
                                                    <div class="cls-gap">
                                                        <div style="text-align: center; box-shadow: none;">
                                                            <button id="payhere-payment">Pay</button>
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
                </div>
            </div>
        </div>
    </div>


    <?php include 'footer.php'; ?>
    <!-- footer -->

    <?php

        
        $merchant_id = "1223737";
        $order_id = uniqid();
        $merchant_secret = "MTM1MTQ1ODA0NDQyOTA5MDI0MDkxNDk2Mzc4NzQwMTI4OTM5Njc5Mg==";
        $currency = "LKR";
        $amount = $_SESSION['grand_total'];
        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

    ?>


    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <script>

        payhere.onCompleted = function onCompleted(orderId) {
            console.log("Payment completed. OrderID:" + orderId);
            
            var name = encodeURIComponent("<?php echo $name; ?>");
            var address = encodeURIComponent("<?php echo $address; ?>");
            var zip = encodeURIComponent("<?php echo $zip; ?>");
            var mobile = encodeURIComponent("<?php echo $mobile; ?>");
            var email = encodeURIComponent("<?php echo $email; ?>");
            var order_id = encodeURIComponent("<?php echo $order_id; ?>");

            window.location.href = "payment-confirmation.php?name=" + name + "&address=" + address + "&zip=" + zip + "&mobile=" + mobile + "&email=" + email + "&order_id=" + order_id;

        };

        payhere.onDismissed = function onDismissed() {
            console.log("Payment dismissed");
        };
        payhere.onError = function onError(error) {
            console.log("Error:"  + error);
        };
        var payment = {
            "sandbox": true,
            "merchant_id": "<?php echo $merchant_id; ?>", 
            "return_url": "http://localhost/advance_lms/payment/payment-option.php",   
            "cancel_url": "http://localhost/advance_lms/payment/payment-option.php",    
            "notify_url": "http://localhost/advance_lms/payment/payment-option.php",
            "order_id": "<?php echo $order_id; ?>",
            "items": "<?php echo $items; ?>",
            "amount": "<?php echo $amount; ?>",
            "currency": "<?php echo $currency; ?>",
            "hash": "<?php echo $hash; ?>", // 
            "first_name": "lahiru",
            "last_name": "Perera",
            "email": "samanp@gmail.com",
            "phone": "0771234567",
            "address": "No.1, Galle Road",
            "city": "Colombo",
            "country": "Sri Lanka",
            "delivery_address": "No. 46, Galle road, Kalutara South",
            "delivery_city": "Kalutara",
            "delivery_country": "Sri Lanka",
            "custom_1": "",
            "custom_2": ""
        };

        document.getElementById('payhere-payment').onclick = function (e) {
            payhere.startPayment(payment);
        };
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
    

<?php

} else {
    header("Location: cart.php");
    exit;
}
?>