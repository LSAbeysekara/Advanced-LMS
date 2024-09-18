<?php 
include('config/constant.php');
session_start();
if(!isset($count)){
    $count = '';
}

if(isset($_POST['addcart'])){

    if(isset($_POST['qtybutton'])){
        $quantity = $_POST['qtybutton'];
    }else{
        $quantity = 1;
    }
     $id = $_POST['id'];

   $_SESSION['cart'][$id] = array('quantity' => $quantity);
    

 }

 if(isset($_SESSION['cart'])){
    $cart = $_SESSION['cart'];
    $count = count($cart);
   }

 ?><!-- header section start here -->
 <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<header class="header-section header-shadow">
        <div class="header-bottom">
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo">
                        <a href="index.html"><img src="assets/images/logo/01.png" alt="logo"></a>
                    </div>
                    <div class="menu-area">
                        <div class="menu">
                            <ul class="lab-ul">
                                <li>
                                    <a href="index.php">Home</a>

                                </li>

                                <li>
                                    <a href="#0">Catogeries</a>
                                    <ul class="lab-ul">
                                        <?php
                                        $sql = "SELECT * FROM `tb_product_catogery` where `status` = 'Active'";
                                        if ($qset = $conn->query($sql)) {
                                            while ($row = $qset->fetch_assoc()) { ?>
                                            <li><a href="index.php?cat=<?php echo $row['procat_id'] ?>"><?php echo $row['procatdesc'] ?></a></li>
                                                <?php
                                            }
                                        } else {
                                            echo $conn->error;
                                        }
                                        ?>
                                        

                                    </ul>

                                </li>

                                <li>
                                    <a href="aboutus.php">About</a>

                                </li>
                                <li>
                                    <a href="contactus.php">Contact us</a>
                                </li>

                                <li>
                                    <a href="http://localhost:3000">LMS</a>

                                </li>
                                <li><a href="cart.php"> <span><i class="fa fa-shopping-cart"></i></span>
                        <span class="badge rounded-pill badge-notification bg-danger"><?php echo $count?></span></a></li>
                            </ul>
                        </div>
                        <?php if (isset($_SESSION['username'])) { ?>
                            <a href="cus_profile.php" class="signup"><i class="icofont-users"></i> <span>My Account</span> </a>
                            <a href="logout.php" class="login"><i class="icofont-users"></i> <span>Log out</span> </a>

                        <?php }else{ ?>
                        <a href="http://localhost:3000/login" class="login"><i class="icofont-user"></i> <span>LOG IN</span> </a>
                        <a href="signup.php" class="signup"><i class="icofont-users"></i> <span>SIGN UP</span> </a>
 <?php } ?>
                        <!-- toggle icons -->
                        <div class="header-bar d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="ellepsis-bar d-lg-none">
                            <i class="icofont-info-square"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header section ending here -->