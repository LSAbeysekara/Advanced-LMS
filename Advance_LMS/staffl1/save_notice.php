<?php
session_start();
include ('config/constant.php');

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $notice_type = $_POST['notice_type'];
    $content = $_POST['content'];
    $course_id = ($notice_type == 'course') ? $_POST['course_id'] : null;
    $end_date = $_POST['end_date'];
    $status = $_POST['status'];
    $user=$_SESSION['admin_id'];
    $query = "INSERT INTO tb_notice (notice_type, title, content, c_id, end_date, status, created_by) VALUES ('$notice_type', '$title', '$content', '$course_id', '$end_date', '$status', '$user')";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Course added successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding course']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
