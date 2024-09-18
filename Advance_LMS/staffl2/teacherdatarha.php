<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = "SELECT * FROM `tb_teacher` where user_type='Extra' and status='Active'";
$result = mysqli_query($conn, $query);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode(array("data" => $data));

mysqli_close($conn);
?>
