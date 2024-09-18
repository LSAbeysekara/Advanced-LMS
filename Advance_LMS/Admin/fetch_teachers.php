<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `tb_teacher`"; 
$result = $conn->query($sql);

$teachers = array();

// while ($row = $result->fetch_assoc()) {
//     $teachers[] = $row;
// }

while ($row = $result->fetch_assoc()) {
    $teachers[] = array(
        'id' => $row['tchr_id'],
        'text' => $row['name']
    );
}
echo json_encode($teachers);
?>
