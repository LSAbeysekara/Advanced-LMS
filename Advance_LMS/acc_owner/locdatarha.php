<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username=$_SESSION['id'];

$query = "SELECT *, c.status, t.`cus_name` AS `teacher_name`
FROM `tb_courses` c
JOIN `tb_customer` t ON c.`t_id` = t.`id` where c.c_type = 'acom' and c.`t_id` = '$username'
";
$result = mysqli_query($conn, $query);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode(array("data" => $data));

mysqli_close($conn);
?>