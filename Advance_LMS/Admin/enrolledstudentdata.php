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
$query = "SELECT e.`enroll_id`, e.`course_id`, e.`st_id`, e.`enroll_date`, e.`status`, e.`created_by`, s.`username`, s.`st_name`
FROM `tb_enrollment` AS e
INNER JOIN `tb_student` AS s ON e.`st_id` = s.`st_id` WHERE e.`course_id` = ?";
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
