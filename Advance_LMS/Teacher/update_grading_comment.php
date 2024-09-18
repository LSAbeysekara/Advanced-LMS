<?php

include('config/constant.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the AJAX request
    $act_id = $_POST['act_id'];
    $username = $_POST['username'];
    $grading = $_POST['grading'];
    $comment = $_POST['comment'];
    $status = $_POST['status'];

    // Update grading, comments, and status in the database
    $sql = "UPDATE tb_submission SET grading = '$grading', comment = '$comment', grading_status = '$status' WHERE act_id = '$act_id' AND st_username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
}

?>