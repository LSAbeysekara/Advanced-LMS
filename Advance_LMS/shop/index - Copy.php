<!DOCTYPE html>
<html lang="zxx">
<?php include('config/constant.php'); ?>

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


    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>Our Shop Pages</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->


    <!-- blog section start here -->
    <div class="shop-page padding-tb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <article>
                        <div class="shop-title d-flex flex-wrap justify-content-between">
                            <p>Showing 01 - 12 of 139 Results</p>
                            <div class="product-view-mode">
                                <a class="active" data-target="grid"><i class="icofont-ghost"></i></a>
                                <a data-target="list"><i class="icofont-listine-dots"></i></a>
                            </div>
                        </div>
                        <div class="shop-product-wrap grid row justify-content-center">
                        <?php
                        $cat = isset($_GET['cat']) ? $_GET['cat'] : null;
                        if ($cat !== null) {
                                    $sql = "SELECT * FROM `tb_product` where `status` = 'Active' && `category` = '$cat'";

                        } else {
                            $sql = "SELECT * FROM `tb_product` "; }

                                    if ($qset = $conn->query($sql)) {
                                        while ($row = $qset->fetch_assoc()) { ?>
                                        

<!-- product start -->
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="product-item">
                                    <div class="product-thumb">
                                        <div class="pro-thumb">
                                            <img src="./images/shop/01.jpg" alt="shop">
                                        </div>
                                        <div class="product-action-link">
                                            <a class="view-modal" data-target="#quick_view"><i class="icofont-eye"></i></a>
                                            
                                            <a href="#"><i class="icofont-cart-alt"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h5><a href="#"><?php echo $row['productname'] ?></a></h5>
                                        <p><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i></p>
                                        <h6>$200</h6>
                                    </div>
                                </div>
                                <div class="product-list-item">
                                    <div class="product-thumb">
                                        <div class="pro-thumb">
                                            <img src="assets/images/shop/01.jpg" alt="shop">
                                        </div>
                                        <div class="product-action-link">
                                            <a class="view-modal" data-target="#quick_view"><i class="icofont-eye"></i></a>
                                           
                                            <a href="#"><i class="icofont-cart-alt"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h5><a href="#"><?php echo $row['productname'] ?></a></h5>
                                        <p><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i></p>
                                        <h6>
                                            $200
                                        </h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                    </div>
                                </div>
                            </div>
<!-- product end -->                <?php
                                        }
                                    } else {
                                        echo $conn->error;
                                    }
                                    ?>
                        </div>
                        <ul class="default-pagination lab-ul">
                            <li>
                                <a href="#"><i class="icofont-rounded-left"></i></a>
                            </li>
                            <li>
                                <a href="#">01</a>
                            </li>
                            <li>
                                <a href="#" class="active">02</a>
                            </li>
                            <li>
                                <a href="#">03</a>
                            </li>
                            <li>
                                <a href="#"><i class="icofont-rounded-right"></i></a>
                            </li>
                        </ul>
                    </article>
               

 </div>

                <div class="col-lg-4 col-12">
                    <aside>
                        <div class="widget widget-search">
                            <form action="/" class="search-wrapper">
                                <input type="text" name="s" placeholder="Search...">
                                <button type="submit"><i class="icofont-search-2"></i></button>
                            </form>
                        </div>
                        <div class="widget shop-widget">
                            <div class="widget-header">
                                <h5>All Categories</h5>
                            </div>
                            <div class="widget-wrapper">
                                <ul class="shop-menu lab-ul">

                                    <li>
                                        <a href="#0">All Products</a>

                                    </li>
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
                            </div>
                        </div>


                    </aside>
                </div>
            </div>
            <div class="modal" id="quick_view">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal"><i class="icofont-close"></i></button>
                        <div class="modal-body">
                            <div class="product-details-inner">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 col-12">
                                        <div class="thumb text-center">
                                            <div class="pro-thumb">
                                                <img src="assets/images/shop/09.jpg" alt="shop">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="product-content">
                                            <h5><a href="#">Product Title Here</a></h5>
                                            <p>
                                                <i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i>
                                            </p>
                                            <h6>$200</h6>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                        </div>
                                        <div class="cart-button">
                                            <div class="cart-plus-minus">
                                                <div class="dec qtybutton">-</div>
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="2">
                                                <div class="inc qtybutton">+</div>
                                            </div>
                                            <a href="#" class="lab-btn"><span>Add to Cart</span></a>
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
    <!-- blog section ending here -->


    <!-- footer -->
    <div class="news-footer-wrap">
        <div class="fs-shape">
            <img src="assets/images/shape-img/03.png" alt="fst" class="fst-1">
            <img src="assets/images/shape-img/04.png" alt="fst" class="fst-2">
        </div>


        <!-- Footer Section Start Here -->
        <footer>
            <div class="footer-top padding-tb pt-0">
                <div class="container">
                    <div class="row g-4 row-cols-xl-4 row-cols-md-2 row-cols-1 justify-content-center">
                        <div class="col">
                            <div class="footer-item">
                                <div class="footer-inner">
                                    <div class="footer-content">
                                        <div class="title">
                                            <h4>Site Map</h4>
                                        </div>
                                        <div class="content">
                                            <ul class="lab-ul">
                                                <li><a href="#">Documentation</a></li>
                                                <li><a href="#">Feedback</a></li>
                                                <li><a href="#">Plugins</a></li>
                                                <li><a href="#">Support Forums</a></li>
                                                <li><a href="#">Themes</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="footer-item">
                                <div class="footer-inner">
                                    <div class="footer-content">
                                        <div class="title">
                                            <h4>Useful Links</h4>
                                        </div>
                                        <div class="content">
                                            <ul class="lab-ul">
                                                <li><a href="#">About Us</a></li>
                                                <li><a href="#">Terms & Conditions</a></li>
                                                <li><a href="#">Contact Us</a></li>
                                                <li><a href="#">Privacy Policy</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="footer-item">
                                <div class="footer-inner">
                                    <div class="footer-content">
                                        <div class="title">
                                            <h4>Social Contact</h4>
                                        </div>
                                        <div class="content">
                                            <ul class="lab-ul">
                                                <li><a href="#">Facebook</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="footer-item">
                                <div class="footer-inner">
                                    <div class="footer-content">
                                        <div class="title">
                                            <h4>Our Support</h4>
                                        </div>
                                        <div class="content">
                                            <ul class="lab-ul">
                                                <li><a href="#">Contact Support</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom style-2">
                <div class="container">
                    <div class="section-wrapper">
                        <!-- <p>&copy; 2021 <a href="index.html">Edukon</a> Designed by <a href="https://themeforest.net/user/CodexCoder" target="_blank">CodexCoder</a> </p> -->
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section Ending Here -->
    </div>
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