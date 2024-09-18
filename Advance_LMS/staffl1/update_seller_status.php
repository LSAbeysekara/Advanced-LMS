<?php
// Check if orderId and status are received via POST
if(isset($_POST['orderId']) && isset($_POST['status'])) {
    // Sanitize input to prevent SQL injection
    $orderId = $_POST['orderId'];
    $status = $_POST['status'];

    // Perform database update
    // Replace "your_database_connection" with your actual database connection code
    include('config/constant.php');

    // Prepare and execute SQL statement
    $sql = "UPDATE tb_student SET seller = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $status, $orderId);
    $stmt->execute();

    // Check if the update was successful
    if($stmt->affected_rows > 0) {
        // Order status updated successfully
        echo json_encode(array("success" => true));
    } else {
        // Failed to update order status
        echo json_encode(array("success" => false, "message" => "Failed to update order status."));
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // orderId or status not received
    echo json_encode(array("success" => false, "message" => "orderId or status not received."));
}
?>
