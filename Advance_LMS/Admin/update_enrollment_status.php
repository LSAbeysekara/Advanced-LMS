<?php
 include('config/constant.php'); 
if (isset($_POST['enroll_id'], $_POST['status'])) {

    $enroll_id = $_POST['enroll_id'];
    $status = $_POST['status'];

   

 
    $sql = "UPDATE tb_enrollment SET status = ? WHERE enroll_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $enroll_id);

    if ($stmt->execute()) {
      
        echo json_encode(array("success" => true, "message" => "Enrollment status updated successfully."));
    } else {
        
        echo json_encode(array("success" => false, "message" => "Failed to update enrollment status."));
    }

   
    $stmt->close();
    $conn->close();
} else {
    
    echo json_encode(array("success" => false, "message" => "Enroll ID and status not provided."));
}
?>
