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
    $tchr_id = $_POST['val-tchr_id'];
    
    $username = $_POST['val-username'];
    $password = $_POST['val-password'];
    $password=sha1($password);
    $status = "Active";
    $nic = $_POST['val-nic'];
    $address = $_POST['val-address'];
    $phone = $_POST['val-phoneus'];

    // Generate unique filenames based on username and teacher name
    $cv = isset($_FILES['val-cv']) ? $username . '_' . $name . '_cv_' . $_FILES['val-cv']['name'] : null;
    $certificate = isset($_FILES['val-certificate']) ? $username . '_' . $name . '_certificate_' . $_FILES['val-certificate']['name'] : null;

    // Validate and sanitize the data if needed

    // Save data to the database
    $query = "UPDATE `tb_teacher` SET `username`='$username',`password`='$password',`nic`='$nic',`status`='$status' WHERE `tchr_id`='$tchr_id'";

    // Execute the query
    mysqli_query($conn, $query);

    // Handle file uploads
    if ($cv !== null) {
        move_uploaded_file($_FILES['val-cv']['tmp_name'], 'upload/cv/teacher/' . $cv);
    }

    if ($certificate !== null) {
        move_uploaded_file($_FILES['val-certificate']['tmp_name'], 'upload/certificates/teacher/' . $certificate);
    }
    // Close the database connection if needed
   mysqli_close($conn);

    echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
