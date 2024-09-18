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

// Get the username prefix from the POST data
$usernamePrefix = $_POST['usernamePrefix']; // Assuming you are sending this from your JavaScript

// Concatenate the prefix with '%' and store it in a separate variable
$searchPattern = $usernamePrefix . '%';

// Prepare and execute a query to find the next available suffix for the given prefix
$sql = "SELECT MAX(CAST(SUBSTRING(username, 10) AS UNSIGNED)) AS max_suffix FROM tb_student WHERE username LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $searchPattern);
$stmt->execute();
$stmt->bind_result($maxSuffix);
$stmt->fetch();
$stmt->close();

// Calculate the next available suffix
$nextSuffix = $maxSuffix + 1;
$nextSuffix = str_pad($nextSuffix, 6, '0', STR_PAD_LEFT); // Ensure 6-digit format

// Return the next available suffix
echo $nextSuffix;

$conn->close();
?>