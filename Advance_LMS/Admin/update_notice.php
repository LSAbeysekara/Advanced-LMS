<?php


include('config/constant.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $title = $content = $end_date = $status = "";
    
    
    $title = trim($_POST["title"]);
    $content = trim($_POST["content"]); 
    $end_date = trim($_POST["end_date"]);
    $status = trim($_POST["status"]);
    $notice_id = trim($_POST["notice_id"]);

    
    $sql = "UPDATE tb_notice SET title = ?, content = ?, end_date = ?, status = ? WHERE notice_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssssi", $title, $content, $end_date, $status, $notice_id);
        
        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records updated successfully
            $response = array(
                "status" => "success",
                "message" => "Notice updated successfully."
            );
        } else {
            $response = array(
                "status" => "error",
                "message" => "Error updating notice. Please try again later."
            );
        }

      
        $stmt->close();
    }
    

    $conn->close();

    
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
   
    $response = array(
        "status" => "error",
        "message" => "Invalid request method."
    );
    
    
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
