<?php
// Check if the order_id parameter is set in the URL
if(isset($_GET['order_id'])) {
    // Get the order ID from the URL parameter
    $orderId = $_GET['order_id'];

    // Example database connection
    include('config/constant.php');

    // Prepare and execute SQL query to update the order status to 'Cancelled'
    $sql = "UPDATE tb_order SET order_status = 'Cancelled' WHERE order_id = '$orderId'";
    if ($conn->query($sql) === TRUE) {
        // If the update query was successful, redirect the user back to the previous page
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        // If there was an error with the update query, display an error message
        echo "Error updating record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    // If the order_id parameter is not set in the URL, display an error message
    echo "Order ID not provided.";
}
?>
