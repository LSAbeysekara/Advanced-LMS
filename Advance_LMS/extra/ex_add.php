<?php include('config/constant.php'); ?>

<?php
    if (!isset($_SESSION['tchr_id'])){
        echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
    } else{ ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Product</title>
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
                        <li class="breadcrumb-item"><a href="index.php">Product</a></li>
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
                                <form class="form-valide" method="post" action="save_activity.php" enctype="multipart/form-data">

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Title<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" name="title" placeholder="Enter your course title here.." required  maxlength="20"><span class=""></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">District <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <select class="form-control serviceDrop" name="district" id="districtSelect" required>
                                                    <option value="">Select District</option>
                                                    <option value="Kandy">Kandy</option>
                                                    <option value="Matale">Matale</option>
                                                    <option value="Nuwara_Eliya">Nuwara Eliya</option>
                                                    <option value="Ampara">Ampara</option>
                                                    <option value="Baticalo">Baticalo</option>
                                                    <option value="Polonnaruwa">Polonnaruwa</option>
                                                    <option value="Trincomale">Trincomale</option>
                                                    <option value="Anuradapura">Anuradapura</option>
                                                    <option value="Vavuniya">Vavuniya</option>
                                                    <option value="Mannar">Mannar</option>
                                                    <option value="Mulativ">Mulativ</option>
                                                    <option value="Jaffna">Jaffna</option>
                                                    <option value="Kilinochchi">Kilinochchi</option>
                                                    <option value="Kurunagala">Kurunagala</option>
                                                    <option value="Puttalam">Puttalam</option>
                                                    <option value="Ratnapura">Ratnapura</option>
                                                    <option value="Galle">Galle</option>
                                                    <option value="Hambantota">Hambantota</option>
                                                    <option value="Matara">Matara</option>
                                                    <option value="Badulla">Badulla</option>
                                                    <option value="Monaragala">Monaragala</option>
                                                    <option value="Kegalle">Kegalle</option>
                                                    <option value="Colombo">Colombo</option>
                                                    <option value="Gampaha">Gampaha</option>
                                                    <option value="Kalutara">Kalutara</option>
                                                    <option value="online" style="color: red;">Online</option>
                                                </select><br>
                                                <input type="text" class="form-control" name="location" id="locationInput" placeholder="Paste your course's location link here.." required>
                                                <span id="linkValidity"></span>
                                                <small id="link_check"></small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Description <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <textarea type="text" class="form-control" name="description" placeholder="Enter a short course description here.." id="charLimitedInput" maxlength="45" required></textarea>
                                                <small class="form-text text-muted" id="charRemaining"></small>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Course Image <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="file" class="form-control" name="c_image" accept="image/*" required><br>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <!-- <input type="hidden" class="btn btn-primary" name="submit" value="submit"> -->
                                                <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Send Request">
                                                <a href="index.php"><input type="button" class="btn btn-primary" style="background-color: red;" value="Cancel"></a>
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
        function checkLinkValidity() {
            const urlPattern = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
            if (urlPattern.test(locationInput.value)) {
                linkCheckMessage.textContent = 'Looks good!';
                linkCheckMessage.style.color = 'green';
                submitButton.disabled = false; // Enable the submit button
            } else {
                linkCheckMessage.textContent = 'Please enter a valid link.';
                linkCheckMessage.style.color = 'red';
                submitButton.disabled = true; // Disable the submit button
            }
        }

        const districtSelect = document.getElementById('districtSelect');
        const locationInput = document.getElementById('locationInput');
        const linkCheckMessage = document.getElementById('link_check');
        const submitButton = document.getElementById('submit');

        districtSelect.addEventListener('change', function() {
            if (this.value === 'online') {
                locationInput.disabled = true;
                locationInput.value = '';
                linkCheckMessage.textContent = '';
                submitButton.disabled = false; // Enable the submit button
            } else {
                locationInput.disabled = false;
                checkLinkValidity();
            }
        });

        locationInput.addEventListener('input', checkLinkValidity);
    </script>


    <script>
        // Get the sentence
        const sentence = "Testing description goes here and this is testing.";

        // Set the input field value to the length of the sentence
        const charLimit = sentence.length;
        document.getElementById('charLimitedInput').setAttribute('maxlength', charLimit);

        // Update the remaining characters count
        const charRemaining = document.getElementById('charRemaining');
        charRemaining.textContent = `${charLimit} characters remaining`;

        // Add event listener to update remaining characters count dynamically
        document.getElementById('charLimitedInput').addEventListener('input', function() {
            const remaining = charLimit - this.value.length;
            charRemaining.textContent = `${remaining} characters remaining`;
        });
    </script>


    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>

    <?php if(isset($_SESSION['add-act-error-no'])){ ?>    
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Uploaded image file is missing or corrupted."
            });
        </script>
    <?php   unset($_SESSION['add-act-error-no']); } ?>

    <?php if(isset($_SESSION['add-act-error-dif'])){ ?>    
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Some problem with your image! Plese try with a new image or renaming the currect image."
            });
        </script>
    <?php   unset($_SESSION['add-act-error-dif']); } ?>

    <?php if(isset($_SESSION['add-act-error'])){ ?>    
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong. Please try again."
            });
        </script>
    <?php   unset($_SESSION['add-act-error']); } ?>

    <?php if(isset($_SESSION['add-act-ok'])){ ?>    
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Date entered successfully",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    <?php   unset($_SESSION['add-act-ok']); } ?>

</body>
</html>
<?php } ?>