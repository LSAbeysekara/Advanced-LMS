<?php
include('config/constant.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemcode = $_POST['itemcode'];
    $catogery = $_POST['catogery'];
    $itemname = $_POST['itemname'];
    $content = $_POST['prodesc'];
    $cost_price = $_POST['cost_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $status = $_POST['status'];

    // File upload handling
    $targetDir = "product_images/";
    $fileName = basename($_FILES["pro_img"]["name"]);
    $targetFilePath = $targetDir . $itemcode . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if folder exists, if not create it
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Upload file
    if (move_uploaded_file($_FILES["pro_img"]["tmp_name"], $targetFilePath)) {
        // File uploaded successfully, proceed to save data to database
        $sql = "INSERT INTO tb_product (item_code, category, productname, prodesc, cost_price, selling_price, status, quantity, pro_img)
                VALUES ('$itemcode', '$catogery', '$itemname', '$content', '$cost_price', '$selling_price', '$status', '$qty', '$targetFilePath')";

        if ($conn->query($sql) === TRUE) {
            // Data saved successfully
            echo json_encode(array("status" => "success", "message" => "Product added successfully."));
        } else {
            // Error occurred while saving data
            echo json_encode(array("status" => "error", "message" => "Error: " . $conn->error));
        }
    } else {
        // Error uploading file
        echo json_encode(array("status" => "error", "message" => "Sorry, there was an error uploading your file."));
    }
} else {
    // Invalid request method
    echo json_encode(array("status" => "error", "message" => "Invalid request method."));
}
?>
