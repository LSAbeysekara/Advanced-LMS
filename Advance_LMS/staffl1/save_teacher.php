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
    $name = $_POST['val-name'];
    $email = $_POST['val-email'];
    $username = $_POST['val-username'];
    $password = $_POST['val-password'];
    $password = sha1($password);
    $nic = $_POST['val-nic'];
    $address = $_POST['val-address'];
    $phone = $_POST['val-phoneus'];

    // Generate unique filenames based on username and teacher name
    $cv = isset($_FILES['val-cv']) ? $username . '_' . $name . '_cv_' . $_FILES['val-cv']['name'] : null;
    $certificate = isset($_FILES['val-certificate']) ? $username . '_' . $name . '_certificate_' . $_FILES['val-certificate']['name'] : null;

    // Validate and sanitize the data if needed

    // Save data to the database
    $query = "INSERT INTO tb_teacher (user_type, name, username, password, email, address, phone, nic, cv, certificates) 
              VALUES ('teacher', '$name', '$username', '$password', '$email', '$address', '$phone', '$nic', '$cv', '$certificate')";

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
