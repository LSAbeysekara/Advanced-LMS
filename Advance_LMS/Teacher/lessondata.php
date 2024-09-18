<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$c_id = $_GET['cid'];  

// Use prepared statements to prevent SQL injection
$query = "SELECT `les_id`, `les_name`, `file`, `file_type`, `status`,`c_id` FROM `tb_lesson` WHERE `c_id` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $c_id); 
$stmt->execute();

$result = $stmt->get_result();

$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(array("data" => $data));

$stmt->close();
$conn->close();
?>
 