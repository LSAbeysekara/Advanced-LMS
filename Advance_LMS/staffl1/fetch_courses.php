<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchTerm = '%' . $_GET['keyword'] . '%';

$sql = "SELECT * FROM `tb_courses` WHERE c_name LIKE ?";
$stmt = $conn->prepare($sql);


if ($stmt === false) {
    die("Error in preparing statement");
}

$stmt->bind_param("s", $searchPattern);
$searchPattern = $searchTerm;


$stmt->execute();


$result = $stmt->get_result();

$courses = array();


while ($row = $result->fetch_assoc()) {
    $courses[] = array(
        'id' => $row['c_id'],
        'text' => $row['c_name']
    );
}


$stmt->close();


$conn->close();

// Output the JSON results
echo json_encode(['results' => $courses]);
?>