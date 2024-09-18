<?php
// Connect to database and include necessary files
include('config/constant.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'get_categories') {
    // Retrieve categories from the database and return as JSON
    $sql = "SELECT procat_id, procatdesc, status FROM tb_product_catogery";
    $result = $conn->query($sql);

    $categories = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        echo json_encode(array('data' => $categories)); // Wrap the categories array in a 'data' key
    } else {
        echo json_encode(array('data' => array())); // Return an empty array if no categories found
    }
} elseif ($action == 'change_status') {
    // Update category status in the database
    $procat_id = $_POST['procat_id'];
    $newStatus = $_POST['status'];

    $sql = "UPDATE tb_product_catogery SET status = '$newStatus' WHERE procat_id = $procat_id";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('status' => 'success')); 
    } else {
        echo "Error updating record: " . $conn->error;
    }
} elseif ($action == 'save_category') {
    // Insert new category into the database
    $categoryName = $_POST['category'];

    $sql = "INSERT INTO tb_product_catogery (procatdesc, status, create_by) VALUES ('$categoryName', 'Active', 'Admin')";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif ($action == 'update_category') {
    // Update category name in the database
    $procat_id = $_POST['procat_id'];
    $newName = $_POST['new_name'];

    $sql = "UPDATE tb_product_catogery SET procatdesc = '$newName' WHERE procat_id = $procat_id";
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
