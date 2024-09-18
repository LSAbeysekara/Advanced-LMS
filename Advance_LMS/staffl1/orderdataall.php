<?php
// Connect to your database
include('config/constant.php');

// Query to fetch all orders and sort them by status and date
$sql = "SELECT tb_order.*, MAX(tb_customer.cus_name) AS cus_name
FROM tb_order
LEFT JOIN tb_customer ON tb_order.cust_id = tb_customer.cus_id
GROUP BY tb_order.order_id, tb_order.order_status, tb_order.order_date
ORDER BY CASE WHEN tb_order.order_status = 'order_placed' THEN 0 ELSE 1 END, tb_order.order_date DESC

";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Return data as JSON
echo json_encode($data);

$conn->close();
?>