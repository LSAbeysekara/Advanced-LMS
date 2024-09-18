<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `tb_courses`"; 
$result = $conn->query($sql);

$teachers = array();

// while ($row = $result->fetch_assoc()) {
//     $teachers[] = $row;
// }

while ($row = $result->fetch_assoc()) {
    $teachers[] = array(
        'id' => $row['c_id'],
        'text' => $row['c_name']
    );
}
echo json_encode($teachers);
?>
