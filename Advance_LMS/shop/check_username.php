<?php
// Database connection
include('config/constant.php');

$username = $_POST['username'];

// Prepare and execute statement
$stmt = $conn->prepare("SELECT * FROM tb_customer WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if the username exists
if ($result->num_rows > 0) {
    echo "<span style='color: red;'>Username already exists</span>";
} else {
    echo "<span style='color: green;'>Username is available</span>";
}

$stmt->close();
$conn->close();
?>
