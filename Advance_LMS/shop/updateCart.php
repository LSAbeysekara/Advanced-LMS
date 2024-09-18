<?php
session_start();

if(isset($_POST['update_cart'])) {
    foreach($_POST['product_id'] as $index => $product_id) {
        $quantity = $_POST['qtybutton'][$index];
        if(isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    }
    header("Location: cart.php");
    exit();
}
?>
