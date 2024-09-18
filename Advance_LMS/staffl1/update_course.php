<?php
include('config/constant.php');

session_start();


if (!isset($_SESSION['admin_name'])) {
    echo json_encode(['success' => false]);
    exit;
}


$courseId = isset($_POST['course_id']) ? $_POST['course_id'] : '';
$courseName = isset($_POST['course_name']) ? $_POST['course_name'] : '';
$teacherId = isset($_POST['teacher_id']) ? $_POST['teacher_id'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';




 $sql = "UPDATE tb_courses SET c_name=?, t_id=?, status=? WHERE c_id=?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("sssi", $courseName, $teacherId, $status, $courseId);
 $result = $stmt->execute();


if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}


 $stmt->close();
 $conn->close();
?>
