<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if (!isset($_SESSION['admin_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else {
    
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>List of Staff</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->

    <link href="css/style.css" rel="stylesheet">
    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js" defer></script>
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Orders</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">List of Orders</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Orders List</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered " id="orderTable">
                                        <thead>
                                            <tr>
                                                <th>Order Date</th>
                                                <th>Order ID</th>
                                                <th>Customer Name</th> 
                                                <th>Amount</th>                                               
                                                <th>Payment Method</th>
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
</div>



    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script>
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        // Initialize DataTable with AJAX
        var table = $j('#orderTable').DataTable({
            "ajax": {
                "url": "orderdataall.php",
                "dataType": "json",
                "dataSrc": "" // Ensure dataSrc is empty or not specified, since your response is already an array
            },
            "columns": [
                { "data": "order_date" },
                {
    "data": "order_id",
    "render": function(data, type, row) {
        if (row.order_status === 'order placed') {
            return  data + ' <span class="badge badge-warning">New</span> ';
        } else {
            return data;
        }
    }
},
                { "data": "cus_name" },
                { "data": "order_total" },               
                { "data": "pay_method" },
                { "data": "order_status" },
                {
                    "data": null,
                    "render": function(data, type, full, meta) {
                        // Add view order button
                        return "<button class='view-btn btn btn-info' data-order-id='" + full.order_id + "'>View</button> &nbsp;&nbsp; <button class='status-btn btn btn-primary' data-order-id='" + full.order_id + "' data-status='" + full.order_status + "'>Change Status</button>";
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

        // Handle click on status button
        $j('#orderTable').on('click', '.status-btn', function() {
            var orderId = $j(this).data('order-id');
            var currentStatus = $j(this).data('status');
            // Show SweetAlert2 confirmation
            Swal.fire({
                title: 'Change Order Status',
                input: 'select',
                inputOptions: {
                    'Processing': 'Processing',
                    'Hand over to Uber': 'Hand over to Uber',
                    'Hand over to Pick Me': 'Hand over to Pick Me',
                    'Delivered': 'Delivered',
                    'Cancelled': 'Cancelled'
                },
                inputValue: currentStatus,
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: (status) => {
                    return $j.ajax({
                        url: 'update_order_status.php',
                        type: 'POST',
                        data: {
                            orderId: orderId,
                            status: status
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    // Reload DataTable on success
                    table.ajax.reload();
                    Swal.fire(
                        'Success!',
                        'Order status has been updated.',
                        'success'
                    );
                }
            });
        });
    });
</script>

    <script src="plugins/common/common.min.js" defer></script>
    <script src="js/custom.min.js" defer></script>
    <script src="js/settings.js" defer></script>
    <script src="js/gleek.js" defer></script>
    <script src="js/styleSwitcher.js" defer></script>

</body>
</html>
<?php } ?>
