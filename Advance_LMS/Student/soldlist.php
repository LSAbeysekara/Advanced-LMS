<?php include ('./config/constant.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php 

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
} else { 
    ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>List of Sold Items</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->

    <link href="css/style.css" rel="stylesheet">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">


        <!--**********************************
            Header start
        ***********************************-->
        <?php include 'header.php'; ?>
        <!--**********************************
            Header end 
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php include 'sidebar.php'; ?>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Sfaff</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">List of Staff</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Sold Items History</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered " id="orderTable">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Order Date</th>
                                                <th>Order ID</th>
                                                <th>Product Name</th>
                                                <th>Qty</th>
                                                <th>Item Price</th>
                                                <th>Order Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--**********************************
            Content body end
        ***********************************-->


            <!--**********************************
            Footer start
        ***********************************-->
            <!-- <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div> -->
            <!--**********************************
            Footer end
        ***********************************-->

            <!--**********************************
        Main wrapper end
    ***********************************-->

            <!--**********************************
        Scripts
    ***********************************-->

            <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js" defer></script>
            <script>
                var $j = jQuery.noConflict();
            </script>
            <script src="plugins/common/common.min.js" defer></script>
            <script src="js/custom.min.js" defer></script>
            <script src="js/settings.js" defer></script>
            <script src="js/gleek.js" defer></script>
            <script src="js/styleSwitcher.js" defer></script>
            <script>
        $j(document).ready(function() {
            var usernames = 'B2024000001';
            var table = $j('#orderTable').DataTable({
                "ajax": {
                    "url": "orderdata1.php",
                    "data": function(d) {
                        d.username = usernames; // Include username in the request data
                    },
                    "dataType": "json",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "product_img",
                        "render": function(data) {
                            return '<img src="' + data + '" alt="Product Image" style="width: 75px; height: 75px;">';
                        }
                    },
                    {
                        "data": "order_date"
                    },
                    {
                        "data": "order_id"
                    },
                    {
                        "data": "product_name"
                    },
                    {
                        "data": "quantity"
                    },
                    {
                        "data": "item_price"
                    },
                    {
                        "data": "order_status"
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            var actionButtons = '';

                            if (row.order_status === 'order placed') {
                                actionButtons += '<button class="cancel-btn btn btn-danger" data-order-id="' + row.order_id + '">Cancel Order</button>';
                            } else if (row.order_status === 'Processing' || row.order_status === 'Hand over to Uber' || row.order_status === 'Hand over to Pick Me') {
                                actionButtons += '<button class="deliver-btn btn btn-success" data-order-id="' + row.order_id + '">Delivered</button> ';
                            }

                            actionButtons += ' <button class="view-btn btn btn-info" data-order-id="' + row.order_id + '">View</button>';

                            return actionButtons;
                        }
                    }
                ]
            });

            // Handle click on view button
            $j('#orderTable').on('click', '.view-btn', function() {
                var orderId = $j(this).data('order-id');
                // Redirect to view order page
                window.location.href = 'view_order.php?id=' + orderId;
            });

            $j('#orderTable').on('click', '.cancel-btn', function() {
                var orderId = $j(this).data('order-id');

                // Ask for confirmation using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to cancel this order.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {

                    if (result.isConfirmed) {

                        window.location.href = 'cancel_order.php?order_id=' + orderId;

                        // Show success message after cancellation
                        Swal.fire(
                            'Cancelled!',
                            'Your order has been cancelled.',
                            'success'
                        );
                    }
                });
            });


            // Handle click on deliver button
            $j('#orderTable').on('click', '.deliver-btn', function() {
                var orderId = $j(this).data('order-id');

                // Ask for confirmation using SweetAlert
                Swal.fire({
                    title: 'Confirm Delivery',
                    text: 'Are you sure you want to mark this order as delivered?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, mark it as delivered!'
                }).then((result) => {
                    // If user confirms, perform delivery action
                    if (result.isConfirmed) {

                        window.location.href = 'deliver_order.php?order_id=' + orderId;
                        // Show success message after delivery
                        Swal.fire(
                            'Delivered!',
                            'The order has been marked as delivered.',
                            'success'
                        );
                    }
                });
            });

        });
    </script>
</body>

</html><?php } ?>