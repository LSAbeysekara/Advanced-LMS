<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .invoice {
            padding: 30px;
        }
        .invoice h2 {
            margin-top: 0;
        }
        .table th, .table td {
            border-top: none !important;
        }
        .table th {
            border-bottom: 1px solid #dee2e6 !important;
        }
        .table td {
            vertical-align: middle !important;
        }
    </style>
</head>
<body>
    <?php
    // Check if order ID is provided
    if(isset($_GET['id'])) {
        // Sanitize input to prevent SQL injection
        $orderId = $_GET['id'];

        // Perform database query to fetch order details
        // Replace "your_database_connection" with your actual database connection code
        include('config/constant.php');

        // Prepare and execute SQL statement to fetch order details
        $sql = "SELECT o.*, od.quantity, p.productname ,od.p_s_price
                FROM tb_order o 
                JOIN tb_order_details od ON o.order_id = od.order_id 
                JOIN tb_product p ON od.pro_id = p.pro_id 
                WHERE o.order_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if order exists
        if($result->num_rows > 0) {
            // Fetch order details
            $order = $result->fetch_assoc();
    ?>
            <div class="container mt-5">
                <div class="invoice">
                    <h2>Order Invoice</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Order ID:</strong> <?php echo $order['order_id']; ?></p>
                            <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
                            <p><strong>Order Status:</strong> <?php echo $order['order_status']; ?></p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p><strong>Customer Name:</strong> <?php echo $order['cus_name']; ?></p>
                            <p><strong>Delivery Address:</strong> <?php echo $order['d_address']; ?></p>
                        </div>
                    </div>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $totalAmount = 0;
                            while($row = $result->fetch_assoc()) { 
                                $totalAmount += $row['quantity'] * $row['p_s_price'];
                            ?>
                                <tr>
                                    <td><?php echo $row['productname']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td>Rs.<?php echo $row['p_s_price']; ?></td>
                                    <td>Rs.<?php echo $row['quantity'] * $row['p_s_price']; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total Amount:</strong></td>
                                <td>Rs.<?php echo $totalAmount; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success" onclick="window.location.href='orderlist.php'">Back to Order List</button>
                </div>
            </div>
    <?php
        } else {
            // Order not found
            echo "<div class='container mt-5'><p class='text-center'>Order not found.</p></div>";
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        // Order ID not provided
        echo "<div class='container mt-5'><p class='text-center'>Order ID not provided.</p></div>";
    }
    ?>
</body>
</html>
