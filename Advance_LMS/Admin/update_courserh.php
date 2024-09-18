<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data

    $tchr_id = $_POST['c_id'];
    $status = "Active";



    // Save data to the database
    $query = "UPDATE `tb_courses` SET `status`='$status' WHERE `c_id`='$tchr_id'";

 
    mysqli_query($conn, $query);

   mysqli_close($conn);

    echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
