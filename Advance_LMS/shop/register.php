<?php
include('config/constant.php');

function generateCustomerId($conn) {
    $query = "SELECT MAX(cus_id) AS max_id FROM tb_customer";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    $max_id = $row['max_id'];

    if ($max_id) {
        $new_id = intval(substr($max_id, 3)) + 1;
        $new_id = str_pad($new_id, 6, '0', STR_PAD_LEFT);
        return "cus" . $new_id;
    } else {
        return "cus000001";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $zip = $_POST['zip'];
    $password = $_POST['password'];
    $password = sha1($password);
    $cus_id = generateCustomerId($conn);

    $stmt = $conn->prepare("INSERT INTO tb_customer (usertype, cus_id, cus_name, username, password, mobile, email, address, zip, j_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
    $usertype = "customer";
    $status = "active";
    $stmt->bind_param("ssssssssss", $usertype, $cus_id, $name, $username, $password, $mobile, $email, $address, $zip, $status);
    
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
