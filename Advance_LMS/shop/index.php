<!DOCTYPE html>
<html lang="zxx">


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
    <?php
// Include database connection and constants file

include 'remstock.php';
// Function to limit text
function limit_text($text, $limit)
{
    if (strlen($text) > $limit) {
        $text = substr($text, 0, $limit) . '...';
    }
    return $text;
}

// Number of products per page
$productsPerPage = 9;

// Get page number from URL, if not present set to 1
$pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate offset for pagination
$offset = ($pageNumber - 1) * $productsPerPage;

// Check if category filter is applied
$cat = isset($_GET['cat']) ? $_GET['cat'] : null;
$categoryFilter = '';
if ($cat !== null) {
    $categoryFilter = "WHERE `category` = '$cat' AND `status` = 'Active'";
}

// Query to get total number of products
$totalProductsQuery = "SELECT COUNT(*) AS total FROM `tb_product` $categoryFilter";
$totalProductsResult = $conn->query($totalProductsQuery);
$totalProducts = $totalProductsResult->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalProducts / $productsPerPage);

// Query to fetch products for current page
$sql = "SELECT * FROM `tb_product` $categoryFilter LIMIT $offset, $productsPerPage";



?>

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
                            <p>Showing <?php echo ($offset + 1) . " - " . min($offset + $productsPerPage, $totalProducts) ?> of <?php echo $totalProducts ?> Results</p>
                            <div class="product-view-mode">
                                <a class="active" data-target="grid"><i class="icofont-ghost"></i></a>
                                <a data-target="list"><i class="icofont-listine-dots"></i></a>
                            </div>
                        </div>
                        <div class="shop-product-wrap grid row justify-content-center">
                            <?php
                            $sqls = "SELECT * FROM `tb_product` $categoryFilter LIMIT $offset, $productsPerPage";
                            $qsets = $conn->query($sqls);

                            if ($qsets->num_rows > 0) {
                                while ($row = $qsets->fetch_assoc()) {
                                    $productId=$row['pro_id'];
                                    $remainingQuantity = getRemainingQuantity($productId, $conn);
                            ?>
                                    <!-- product start -->
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="product-item">
                                            <div class="product-thumb">
                                                <div class="pro-thumb">
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
                                                <img src="<?php echo $image_path;?>" alt="shop">
                                                </div>
                                                <div class="product-action-link">
                                                    <a class="view-modal" href="product.php?id=<?php echo $row['pro_id']; ?>"><i class="icofont-eye"></i></a>
                                                    <a href="#"><i class="icofont-cart-alt"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h5><a href="product.php?id=<?php echo $row['pro_id']; ?>"><?php echo $row['productname'] ?></a></h5>
                                                
                                                <h6>Rs.<?php echo  number_format($row['selling_price'],2) ?></h6>
                                            </div>
                                            <form method="post" action="#">
                                            <div class="cart-button">
                                                
                                                <div class="cart-plus-minus">
                                                    <div class="dec qtybutton">-</div>
                                                    <input type="hidden" name="id" value="<?php echo $row['pro_id']; ?>" />
                                                    <input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" min="1" max="<?php echo $remainingQuantity; ?>">
                                                    <div class="inc qtybutton">+</div>
                                                </div>
                                                <br>
                                                <?php if($remainingQuantity<0){ ?>
                                                    <center><a class="lab-btn" href="product.php?id=<?php echo $row['pro_id']; ?>">Read More</a></center>
                                            <?php    }else{ ?>
                                                <center><input type="submit" class="lab-btn" name="addcart" value="Add to Cart"></center> <?php } ?>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                                    <!-- product end -->

                                   
                            <?php
                                }
                            } else {
                                echo "No products found";
                            }
                            ?>
                        </div>
                        <!-- Pagination -->
                        <ul class="default-pagination lab-ul">
                            <?php
                            // Previous page link
                            if ($pageNumber > 1) {
                                echo '<li><a href="?page=' . ($pageNumber - 1) . '"><i class="icofont-rounded-left"></i></a></li>';
                            }

                            // Page numbers
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li><a href="?page=' . $i . '"' . ($pageNumber == $i ? ' class="active"' : '') . '>' . $i . '</a></li>';
                            }

                            // Next page link
                            if ($pageNumber < $totalPages) {
                                echo '<li><a href="?page=' . ($pageNumber + 1) . '"><i class="icofont-rounded-right"></i></a></li>';
                            }
                            ?>
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
            </div>
        </div>
    </div>
    <!-- blog section ending here -->

    <?php include 'footer.php'; ?>




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