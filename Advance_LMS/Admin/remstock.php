<?php
function getRemainingQuantity($productId, $conn) {
    // Query to get the total quantity of the product
    $productQuery = "SELECT `quantity` FROM `tb_product` WHERE `pro_id` = '$productId'";
    $productResult = mysqli_query($conn, $productQuery);

    if (!$productResult) {
        // Handle error if query fails
        die("Error: " . mysqli_error($conn));
    }

    $productRow = mysqli_fetch_assoc($productResult);
    $totalQuantity = $productRow['quantity'];

    // Query to get the sum of ordered quantities for the product with order status not equal to "Cancelled"
    $orderedQuantityQuery = "SELECT SUM(`quantity`) AS `ordered_quantity` 
                             FROM `tb_order_details` od 
                             INNER JOIN `tb_order` o ON od.order_id = o.order_id 
                             WHERE od.pro_id = '$productId' 
                             AND o.order_status != 'Cancelled'";
    $orderedQuantityResult = mysqli_query($conn, $orderedQuantityQuery);

    if (!$orderedQuantityResult) {
        // Handle error if query fails
        die("Error: " . mysqli_error($conn));
    }

    $orderedQuantityRow = mysqli_fetch_assoc($orderedQuantityResult);
    $orderedQuantity = $orderedQuantityRow['ordered_quantity'];

    // Calculate remaining quantity
    $remainingQuantity = $totalQuantity - $orderedQuantity;

    return $remainingQuantity;
}

// Usage example:
// $productId = 1; // Replace with the actual product ID
// $remainingQuantity = getRemainingQuantity($productId, $conn);
// echo "Remaining Quantity: " . $remainingQuantity;

?>
