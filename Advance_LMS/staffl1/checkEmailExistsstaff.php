<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the email from the POST data
$email = $_POST['email'];

// Check if the email already exists in the database
$emailExists = false;
$stmtEmailCheck = $conn->prepare("SELECT COUNT(*) FROM tb_adminstration WHERE email = ?");
$stmtEmailCheck->bind_param("s", $email);
$stmtEmailCheck->execute();
$stmtEmailCheck->bind_result($emailCount);
$stmtEmailCheck->fetch();
$stmtEmailCheck->close();

if ($emailCount > 0) {
    $emailExists = true;
}

// If the email exists, return 'exists', otherwise return 'not exists'
echo ($emailExists) ? 'exists' : 'not exists';

$conn->close();
?>
