<?php
// Connect to your database
include('config/constant.php');



// Fetch orders based on the provided username
$username = $_REQUEST['username'];


// Prepare SQL query to fetch order data with product information
$sql = "SELECT o.order_date, o.order_id, p.item_code, p.productname, od.quantity, od.p_s_price, o.order_status
        FROM tb_order o
        INNER JOIN tb_order_details od ON o.order_id = od.order_id
        INNER JOIN tb_product p ON od.pro_id = p.pro_id
        WHERE o.cust_id = '$username' order by o.order_id desc";
$result = $conn->query($sql);

// Initialize an array to store order data
$orderData = [];

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Loop through each row and add it to the orderData array
    while ($row = $result->fetch_assoc()) {

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

        $orderData[] = [
            "order_date" => $row["order_date"],
            "order_id" => $row["order_id"],
            "product_img" => $image_path,
            "product_name" => $row["productname"],
            "quantity" => $row["quantity"],
            "item_price" => $row["p_s_price"],
            "order_status" => $row["order_status"]
        ];
    }
}

// Close database connection
$conn->close();

// Output order data as JSON
echo json_encode($orderData);
?>
