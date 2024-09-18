<?php include('config/constant.php'); ?>

<?php

if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
}else{ ?>

<?php $username = $_SESSION['username']; ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>All Journals</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.tiny.cloud/1/ipootvjlv9vz4p1d1x91ok27oce25gt4no6r0tddj5c98lsw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <style>
        .cancel{
            background-color: #E25F2E;
            height: 100%;
            width: 60px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            border: none;
        }

        .cancel:hover{
            background-color: #973713;
        }

        .middle{
            text-align: center;
        }

        .content {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>

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
                        <li class="breadcrumb-item"><a href="./index.php">Product</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product</a></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                    
                        <h2>All Forums</h2>

                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">
                                    <?php
                                        $sql = "SELECT * FROM tb_forum WHERE status = 'Active' ORDER BY id DESC";

                                        $res = mysqli_query($conn, $sql);
        
                                        $count = mysqli_num_rows($res);
            
                                        if($count>0)
                                        {
                                            while($row=mysqli_fetch_assoc($res))
                                            {
                                                $forum_id = $row['id'];
                                                $title = $row['title']; 
                                                $content = $row['content'];
                                                $created_by = $row['created_by'];
                                                $created_dt = $row['created_dt']; 



                                                $sql1 = "SELECT * FROM tb_student WHERE username = '$created_by'";

                                                $res1 = mysqli_query($conn, $sql1);
                
                                                $count1 = mysqli_num_rows($res1);
                    
                                                if($count1>0)
                                                {
                                                    while($row=mysqli_fetch_assoc($res1))
                                                    {
                                                        $name = $row['st_name'];
                                                    }
                                                } ?>


                                                <div class="card" style="margin-bottom: 5px;">
                                                    <div class="card-body">
                                                        <div class="form-validation">
                                                            <h4><a href="forum_show.php?forum_id=<?php echo $forum_id; ?>"><?php echo $name." - "; echo $title; ?></a></h4>
                                                            <p class="content"><?php echo $content; ?></p>
                                                        </div>
                                                    </div>
                                                </div>


                                            <?php
                                            }
                                        }else{ ?>
                                            <div class="middle">
                                                <?php echo "You haven't make any forums yet"; ?>
                                            </div>
                                        <?php } ?>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">

        </div>
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

    <script>
        jQuery.noConflict();

    </script>
        <script>
    function checkitemcode() {
        var itemcode = $('#itemcode').val();

        $.ajax({
            url: 'checkitem.php', // Replace with the actual URL where you check the username
            method: 'POST',
            data: { itemcode: itemcode },
            success: function(response) {
                var messageElement = $('#itemdb');

                if (response === 'exist') {
                    messageElement.text('Itemcode already exists').css('color', 'red');
                    $('#submitBtn').prop('disabled', true);
                } else {
                    messageElement.text('Available to use ').css('color', 'green');
                    $('#submitBtn').prop('disabled', false);
                }
            }
        });
    }

    jQuery(document).ready(function() {
        $('#itemcode').on('blur', function() {
            checkitemcode();
        });
    });
</script>
    <script>
        tinymce.init({
            selector: 'textarea#prodesc',
            plugins: ' autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            // ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
    </script>


    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>

<?php } ?>