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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $nic = $_POST['nic'];
    $address = $_POST['address'];
    $phone = $_POST['mobile'];
    $status='Pending';
    // Generate unique filenames based on username and teacher name
    $cv = isset($_FILES['val-cv']) ? $username . '_' . $name . '_cv_' . $_FILES['val-cv']['name'] : null;
    $certificate = isset($_FILES['val-certificate']) ? $username . '_' . $name . '_certificate_' . $_FILES['val-certificate']['name'] : null;

    // Validate and sanitize the data if needed

    // Save data to the database
    $query = "INSERT INTO tb_teacher (user_type, name, email, address, phone, nic, cv, certificates,status) 
              VALUES ('Extra', '$name', '$email', '$address', '$phone', '$nic', '$cv', '$certificate','$status')";

    // Execute the query
    mysqli_query($conn, $query);

    // Handle file uploads
    if ($cv !== null) {
        move_uploaded_file($_FILES['val-cv']['tmp_name'], './Admin/upload/cv/ecteacher/' . $cv);
    }

    if ($certificate !== null) {
        move_uploaded_file($_FILES['val-certificate']['tmp_name'], './Admin/upload/certificates/ecteacher/' . $certificate);
    }
    // Close the database connection if needed
   mysqli_close($conn);

    echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
