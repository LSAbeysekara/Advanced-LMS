<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $act_id = $_POST['id'];

    include('config/constant.php');
    $sql = "DELETE FROM tb_activity WHERE act_id = '$act_id'";

    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'error' => $conn->error);
    }

    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = array('success' => false, 'error' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
