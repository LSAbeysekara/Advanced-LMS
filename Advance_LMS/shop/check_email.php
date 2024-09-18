<?php
include('config/constant.php');

$email = $_POST['email'];

// Prepare and execute statement
$stmt = $conn->prepare("SELECT * FROM tb_customer WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if the email exists
if ($result->num_rows > 0) {
    echo "<span style='color: red;'>Email already exists</span>";
} else {
    echo "<span style='color: green;'>Email is available</span>";
}

$stmt->close();
$conn->close();
?>
