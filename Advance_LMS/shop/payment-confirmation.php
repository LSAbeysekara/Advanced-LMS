<?php include('./config/constant.php');
session_start(); ?>

<?php
$cus_id = $_SESSION['cus_id'];
$order_total = $_SESSION['grand_total'];
$cart=$_SESSION['cart'];


$name = $_GET['name'];
$address = $_GET['address'];
$zip = $_GET['zip'];
$mobile = $_GET['mobile'];
$email = $_GET['email'];

date_default_timezone_set('Asia/Colombo');
$currentDateTime = date('Y-m-d H:i:s');
?>

<?php
//first table
$sql1 = "INSERT INTO tb_order SET
     order_total = '$order_total',
     order_status = 'order placed',
     pay_method = 'Online',
     order_date = '$currentDateTime',
     cust_id = '$cus_id',
     cus_name = '$name',
     mobile = '$mobile',
     d_address = '$address',
     zip = '$zip'
 ";

$res1 = mysqli_query($conn, $sql1);
if ($res1) {

    $orderid = mysqli_insert_id($conn);

    foreach ($cart as $key => $value) {
        $sql_cart = "SELECT * FROM tb_product where pro_id= $key";
        $result_cart = mysqli_query($conn, $sql_cart);
        $row_cart = mysqli_fetch_assoc($result_cart);
        $price_product = $row_cart['selling_price'];
        $q  = $value["quantity"];
        $insertordersItems = "INSERT INTO tb_order_details (order_id, pro_id, quantity, p_s_price) VALUES ('$orderid', '$key', '$q', '$price_product')";
        $insertordersItemsin = mysqli_query($conn, $insertordersItems);
        echo $insertordersItems . "</br>";
        if ($insertordersItemsin) {

            unset($_SESSION['cart']);
            unset($_SESSION['grand_total']);
            $_SESSION['order-details-add-ok'] = "Added";
            echo '<script>window.location.href = "cus_profile.php";</script>';
            
        }
    }
}else {
    $_SESSION['order-details-add-error'] = "error";
    header('location: ./index.php');
}

?>
