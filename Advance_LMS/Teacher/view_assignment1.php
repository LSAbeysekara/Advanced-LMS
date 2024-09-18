<?php
session_start(); 


 if (!isset($_SESSION['teacher_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
  } else {
    $c_id = $_GET['id'];
    ?>
    
    
    <?php
include('config/constant.php');

    if(isset($_GET['aid'])){
        $act_id = $_GET['aid'];

        $sql = "SELECT * FROM tb_activity WHERE act_id = '$act_id'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count>0){
            
            while($row=mysqli_fetch_assoc($res)){
                $act_name = $row['act_name'];
                $file_name = $row['file_name'];
                $content = $row['content'];
                $deadline = $row['deadline'];
                $created = $row['created'];
                $c_id = $row['c_id'];
                $status = $row['status'];
            } ?>

        <?php
        }else{
            $_SESSION['add-error'] = "error";
            header('location: add-assignment.php');
        }
        
    }
    else{
        $_SESSION['add-error'] = "error";
        header('location: add-assignment.php');
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
   
  
    <title>View Assignment</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">

    <link href="css/style.css" rel="stylesheet">

    <script src="https://cdn.tiny.cloud/1/ipootvjlv9vz4p1d1x91ok27oce25gt4no6r0tddj5c98lsw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
            <div class="container-fluid">
                <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">    
                                    <h3> <?php echo $act_id.' - '.$act_name; ?></h3>
                                    <div>
                                        <?php echo $content; ?>
                                    </div>
                                    <div>
                                        <?php
                                            $pdfFilePath = './activities/'.$file_name;
                                            $pdfFileName = basename($pdfFilePath);

                                            if (file_exists($pdfFilePath)) {
                                                ?>
                                                <a href="<?php echo $pdfFilePath; ?>" download="<?php echo $pdfFileName; ?>">
                                                    <?php echo $pdfFileName; ?>
                                                </a>
                                                <?php
                                            } else {
                                                echo "File not found!";
                                            }
                                        ?>
                                    </div><br>
                                    <div>
                                        <form action="download.php" method="post">
                                            <input type="hidden" name="act_id" value="<?php echo $act_id; ?>">
                                            <button type="submit" class="" name="submit">Download Answers</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #/ container -->
            </div>
        </div>
        
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

    <script>
        tinymce.init({
        selector: 'textarea#content',
        plugins: ' autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        });
</script>


   

</body>

</html>
<?php } ?>