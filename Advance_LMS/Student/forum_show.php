<?php include('config/constant.php'); ?>

<?php $username = $_SESSION['username'];?> 
<?php
if (!isset($_SESSION['username']) || ($_SESSION['status'] != 'Active')) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else if ($_SESSION['status'] == 'Pending') {
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/pending_students.php'); </script>";
} else { ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Journal</title>
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
        .col-lg-2, .col-form-label{
            max-width: 80px;
        }

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

        .comment-other{
            background-color: #CEF7D5;
            padding: 0.8em 0.5em 0.2em 0.5em;
            border-radius: 5px;
        }
        
        .comment-own{
            background-color: #F9E1BD;
            padding: 0.8em 0.5em 0.2em 0.5em;
            border-radius: 5px;
        }

        .actions{
            padding: 0.8em 0.5em 0.2em 0.5em;
            border-radius: 5px;
        }

        .middle{
            text-align: center;
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
            <!-- row -->


            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-validation">

                                    <?php 
                                        if (isset($_GET['forum_id'])) {

                                            $forum_id = $_GET['forum_id'];
                                        
                                        }else{
                                            $_SESSION['show-forum-error'] = "Error";
                                            header("Location: ./journal_form.php");
                                            exit;
                                        }

                                        $sql = "SELECT * FROM tb_forum WHERE id = '$forum_id'";

                                        $res = mysqli_query($conn, $sql);
        
                                        $count = mysqli_num_rows($res);
            
                                        if($count>0)
                                        {
                                            while($row=mysqli_fetch_assoc($res))
                                            {
                                                $title = $row['title'];
                                                $content = $row['content'];
                                            }
                                        }
                                    ?>
                                    <form class="form-valide" method="post" action="save_comment.php" enctype="multipart/form-data">

                                        <div style="display: inline-block;">
                                            <h2 style="display: inline;"><?php echo $title; ?></h2>
                                            <?php echo " by "; ?>
                                            <a href="profile_display.php?st_username=<?php echo $username; ?>"><?php echo $username; ?></a>
                                        </div><br><br>

                                        <p><?php echo $content; ?></p><br><br>

                                        <?php
                                        $sql1 = "SELECT * FROM tb_forum_content WHERE forum_id = '$forum_id'";

                                        $res1 = mysqli_query($conn, $sql1);
        
                                        $count1 = mysqli_num_rows($res1);
            
                                        if($count1>0)
                                        {
                                            while($row=mysqli_fetch_assoc($res1))
                                            {
                                                $id = $row['id']; 
                                                $content = $row['content'];
                                                $posted_by = $row['posted_by']; 
                                                  
                                                
                                                $sql2 = "SELECT * FROM tb_student WHERE username = '$posted_by'";

                                                $res2 = mysqli_query($conn, $sql2);

                                                $count2 = mysqli_num_rows($res2);

                                                if($count2>0)
                                                {
                                                    while($row=mysqli_fetch_assoc($res2))
                                                    {
                                                        $pro_img = $row['pro_img'];
                                                    }
                                                }
                                                ?>

                                                <div class="form-group row">
                                                    <a href="profile_display.php?st_username=<?php echo $posted_by; ?>"><label class="col-lg-2 col-form-label"><img class="mr-3" src="./images/profile-pic/<?php echo $pro_img; ?>" alt="" width="40px" height="40px" style="border-radius: 50%; cursor: pointer;"></label></a>
                                                    
                                                <?php if($posted_by == $username){    ?>
                                                    <div class="col-lg-8 comment-own"><?php echo $content; ?></div>

                                                    <div class="col-lg-3 actions" style="display: inline-block;">
                                                        <button class="btn btn-primary reject-link" onclick="confirmDelete(<?php echo $id; ?>, <?php echo $forum_id; ?>)" style="background-color: #BC4B0B;">Delete</button>
                                                        <a href="edit_comment.php?comment_id=<?php echo $id; ?>&forum_id=<?php echo $forum_id; ?>" class="btn btn-primary" style="background-color: #1964B0;">Edit</a>
                                                    </div>


                                                    <?php } else { ?>

                                                        <div class="col-lg-8 comment-other"><?php echo $content; ?></div>

                                                    <?php } ?>

                                                    
                                                    
                                                </div>

                                            <?php
                                            }
                                        }else{ ?>

                                            <div class="middle">
                                                <?php echo "No comments added yet"; ?>
                                            </div>

                                        <?php
                                        }
                                        ?>

                                        <br><br>

                                        <div class="form-group row">
                                            <div class="col-lg-10">
                                                <textarea type="text" class="form-control" id="prodesc" name="comment" placeholder="Enter your comment here.."></textarea>
                                            </div>
                                        </div>

                                        <input type="hidden" name="forum_id" value="<?php echo $forum_id; ?>">
                                        
                                        <div class="form-group row">
                                            <div class="col-lg-12 ml-auto">
                                                <input type="submit" class="btn btn-primary" id="submitBtn" name="submit" value="Post Comment">
                                            </div>
                                        </div>
                                    </form>
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

    <script>    
        document.body.addEventListener('click', function (event) {
            if (event.target.classList.contains('reject-link')) {
                event.preventDefault(); 
                var com_id = event.target.getAttribute('data-req-id1');

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this details!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location.href = `./delete_comment.php?comment_id=${com_id}`;
                    } else {
                    }
                });
            }
        });
    </script>



<script>
    function confirmDelete(commentId, forumId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // If user confirms deletion, redirect to delete_comment.php with the comment ID and forum ID
                window.location.href = `delete_comment.php?comment_id=${commentId}&forum_id=${forumId}`;
            }
        });
    }
</script>


    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

</body>

</html>

<?php } ?>