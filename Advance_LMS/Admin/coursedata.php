<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = "SELECT c.`c_id`, c.`c_name`, c.`c_type`, t.`name` AS `teacher_name`, c.`status`
FROM `tb_courses` c
JOIN `tb_teacher` t ON c.`t_id` = t.`tchr_id`;
";
$result = mysqli_query($conn, $query);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode(array("data" => $data));

mysqli_close($conn);
?>
