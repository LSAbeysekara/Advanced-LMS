<?php include ('./config/constant.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php 

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
} else { 
  
    $username=$_SESSION['username'];
    ?>
    
   
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>List of Student</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
 
    <link href="css/style.css" rel="stylesheet">
<!-- Include jQuery library -->

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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Student</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">List of Products</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Product List</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered " id="proTable">
                                        <thead>
                                            <tr>
                                            <th>Image</th>
                                            <th>Item Code</th>
                                            <th>Product Name</th>
                                            <th>Cost Price</th>
                                            <th>Selling Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
    </table>

        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <!-- <div class="footer">

        </div> -->
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
        var usernames = '<?php echo $username; ?>';
            var table = $j('#proTable').DataTable({
                "ajax": {
                    "url": "stprolist.php",
                    "data": function(d) {
                        d.username = usernames; // Include username in the request data
                    },
                    "dataType": "json",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": "pro_img",
                        "render": function(data) {
                            return '<img src="' + data + '" alt="Product Image" style="width: 75px; height: 75px;">';
                        }
                    },
                    {
                        "data": "item_code"
                    },
                    {
                        "data": "productname"
                    },
                    {
                        "data": "cost_price"
                    },
                    {
                        "data": "selling_price"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            var actionButtons = '';

                                actionButtons += '<button class="edit-btn btn btn-success" data-order-id="' + row.pro_id + '">Edit</button> ';
                         

                            actionButtons += ' <button class="view-btn btn btn-info" data-order-id="' + row.pro_id + '">View</button>';

                            return actionButtons;
                        }
                    }
                ]
            });

            $j('#proTable').on('click', '.view-btn', function() {
                                            var orderId = $j(this).data('order-id');
                                            // Redirect to view order page
                                            window.location.href = 'product_view.php?id=' + orderId;
                                        });

                                        $j('#proTable').on('click', '.edit-btn', function() {
                                            var orderId = $j(this).data('order-id');
                                            // Redirect to view order page
                                            window.location.href = 'product_edit.php?pro_id=' + orderId;
                                        });
                                        // Handle click on status button
                                       

    });
</script>
</body>

</html><?php } ?>