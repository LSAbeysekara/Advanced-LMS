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

$sql = "SELECT tchr_id, name FROM tb_teacher WHERE name LIKE ?";
$stmt = $conn->prepare($sql);


if ($stmt === false) {
    die("Error in preparing statement");
}

$stmt->bind_param("s", $searchPattern);
$searchPattern = $searchTerm;


$stmt->execute();


$result = $stmt->get_result();

$teachers = array();


while ($row = $result->fetch_assoc()) {
    $teachers[] = array(
        'id' => $row['tchr_id'],
        'text' => $row['name']
    );
}


$stmt->close();


$conn->close();

// Output the JSON results
echo json_encode(['results' => $teachers]);
?>
