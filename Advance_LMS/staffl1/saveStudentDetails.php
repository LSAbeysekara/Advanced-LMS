<?php

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "advance_lms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the POST request
$email = $_POST['email'];
$username = $_POST['username'];
$password = sha1($_POST['password']); 

// Insert the new student record into the database
$stmt = $conn->prepare("INSERT INTO tb_student (email, username, password, status) VALUES (?, ?, ?, 'Pending')");
$stmt->bind_param("sss", $email, $username, $password);

if ($stmt->execute()) {
    // Success, return success message to the client-side JavaScript
    echo 'success';
} else {
    // Error, return an error message to the client-side JavaScript
    echo 'Error saving student details.';
}

$stmt->close();
$conn->close();

?>