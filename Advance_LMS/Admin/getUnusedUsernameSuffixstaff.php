<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$usernamePrefix = $_POST['usernamePrefix']; 


$searchPattern = $usernamePrefix . '%';


$sql = "SELECT MAX(CAST(SUBSTRING(username, 6) AS UNSIGNED)) AS max_suffix FROM tb_adminstration WHERE username LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $searchPattern);
$stmt->execute();
$stmt->bind_result($maxSuffix);
$stmt->fetch();
$stmt->close();

$nextSuffix = $maxSuffix + 1;
$nextSuffix = str_pad($nextSuffix, 6, '0', STR_PAD_LEFT); 
echo $nextSuffix;

$conn->close();
?>