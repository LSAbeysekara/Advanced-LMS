<?php
// Connect to your database
include('config/constant.php');

// Fetch products based on the provided username
$username = $_REQUEST['username'];

// Prepare SQL query to fetch product data
$sql = "SELECT *
        FROM tb_product
        ";

$result = $conn->query($sql);

// Initialize an array to store product data
$productData = [];

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Loop through each row and add it to the productData array
    while ($row = $result->fetch_assoc()) {

        $item_code = $row['item_code'];
        $jpg_path = "../shop/product_items/{$item_code}/{$item_code}-1.jpg";
        $png_path = "../shop/product_items/{$item_code}/{$item_code}-1.png";
        $jpeg_path = "../shop/product_items/{$item_code}/{$item_code}-1.jpeg";

        if (file_exists($jpg_path)) {
            $image_path = $jpg_path;
        } elseif (file_exists($png_path)) {
            $image_path = $png_path;
        } elseif (file_exists($jpeg_path)) {
            $image_path = $jpeg_path;
        } else {
            $image_path = "../shop/product_items/no_image.jpg"; 
        }

        $productData[] = [
            "pro_id" => $row["pro_id"],
            "item_code" => $row["item_code"],
            "category" => $row["category"],
            "productname" => $row["productname"],
            "prodesc" => $row["prodesc"],
            "cost_price" => $row["cost_price"],
            "selling_price" => $row["selling_price"],
            "status" => $row["status"],
            "quantity" => $row["quantity"],
            "create_by" => $row["create_by"],
            "create_date" => $row["create_date"],
            "pro_img" => $image_path
        ];
    }
}

// Close database connection
$conn->close();

// Output product data as JSON
echo json_encode($productData);
?>
