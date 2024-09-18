<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukon</title>
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
    <?php include 'remstock.php'; ?>
    <?php 
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_product WHERE pro_id = '$id'";
    
    $qsets = $conn->query($sql);
    $row = $qsets->fetch_assoc();

    ?>
    <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
   
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $row['productname'] ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    
    <!-- blog section start here -->
    <div class="shop-single padding-tb">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <article>
                        <div class="product-details">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <div class="product-thumb">
                                        <div class="swiper-container pro-single-top">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                <?php 
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
                                                    <div class="single-thumb"><img src="<?php echo $image_path; ?>" alt="shop"></div>
                                                </div>
  
                                            </div>
                                        </div>

                                        
                                        <div class="pro-single-next"><i class="icofont-rounded-left"></i></div>
                                        <div class="pro-single-prev"><i class="icofont-rounded-right"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="post-content">
                                        <h4><?php echo $row['productname'] ?></h4>
                                        <h5>Rs.<?php echo  number_format($row['selling_price'],2) ?></h5>
                                          <h6>Product Description</h6> 
                                        <P>SKU:<?php echo $row['item_code'] ?></p>
                                        <!-- <p>Energistia an deliver atactica metrcs after avsionary Apropria trnsition enterpris an sources applications emerging 	psd template communities.</p> -->
                                        <form method="post" action="#">
                                            <div class="cart-plus-minus" style="align-content:left; float:left">
                                                <div class="dec qtybutton">-</div>
                                                <input type="hidden" name="id" value="<?php echo $row['pro_id']; ?>" />
                                                
                                                <?php                                     $productId=$row['pro_id'];
                                    $remainingQuantity = getRemainingQuantity($productId, $conn); ?>
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" min="1" max="<?php echo $remainingQuantity; ?>">

                                            <?php if($remainingQuantity<0){ ?>
                                                <div class="inc qtybutton">+</div>
                                            </div></br></br>
                                                    <h4>Out of  Stock</h4>
                                            <?php    }else{ ?>
                                                <div class="inc qtybutton">+</div>
                                            </div></br></br>
                                                <input type="submit" class="lab-btn" name="addcart" value="Add to Cart"><?php } ?>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="review">
                            <ul class="review-nav lab-ul">
                                <!-- <li class="desc active" data-target="description-show">Description</li> -->
                                <li class="rev " data-target="review-content-show">Description</li>
                            </ul>
                            <div class="review-content review-content-show">
                                <div class="review-showing description">
                                <?php echo $row['prodesc'] ?>
                                </div>
                                <div class="description ">

                                </div>
                            </div>
                        </div>
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
                                    <li><a href="index.php">All Products</a></li>
                                    <?php
                                    $sql = "SELECT * FROM `tb_product_catogery` where `status` = 'Active'";
                                    if ($qset = $conn->query($sql)) {
                                        while ($row = $qset->fetch_assoc()) {
                                    ?>
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
    
                 
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- blog section ending here -->


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