<!DOCTYPE html>
<html lang="en">
<?php include('config/constant.php'); ?>
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
        <title>Edit Teacher</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
        <!-- Custom Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
            <?php
            $tch_id = $_GET['id'];

            $sql = "SELECT * FROM `tb_teacher` where tchr_id='$tch_id'"; // Adjust the table and column names

            $result = $conn->query($sql);


            while ($row = $result->fetch_assoc()) {

            ?>
                <div class="content-body">

                    <div class="row page-titles mx-0">
                        <div class="col p-md-0">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Teacher</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Teacher</a></li>
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
                                            <form class="form-valide" method="post" id="teacherForm">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Username <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-username" value="<?php echo $row['username'] ?>" name="val-username" placeholder="Enter a username.." readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Name <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-name" name="val-name" value="<?php echo $row['name'] ?>" placeholder="Enter a name..">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-email" name="val-email" value="<?php echo $row['email'] ?>" placeholder="Your valid email.."><span id="emailMessage" class="text-danger"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="button" class="btn btn-primary" onclick="generateDetails()">Generate</button>
                                            </div>
                                        </div>

                                                <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-password">Password <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="val-password" name="val-password" placeholder="Choose a safe one.." readonly>
                                            </div>
                                        </div>


                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-nic">NIC <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-nic" value="<?php echo $row['nic'] ?>" name="val-nic" placeholder="842102840V / 200021002840">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-address">Address <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-address" value="<?php echo $row['address'] ?>" name="val-address" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Phone <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-phoneus" value="<?php echo $row['phone'] ?>" name="val-phoneus" placeholder="0777123456">
                                                        <input type="hidden" class="form-control" id="val-tchr_id" value="<?php echo $tch_id ?>" name="val-tchr_id" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Status <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <input type="text" class="form-control" id="val-phoneus" value="<?php echo $row['status'] ?>" name="val-phoneus" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-cv">CV <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        
                                                        <button class="btn btn-info" onclick="downloadCV('<?php echo $row['cv']; ?>')">Download</button>
                                                        
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-certificate">Certificate <span class="text-danger">*</span></label>
                                                    <div class="col-lg-6">
                                                        <button class="btn btn-info" onclick="downloadCertificate('<?php echo $row['certificates']; ?>')">Download</button>
                                                    </div>
                                                </div>

                                                

                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm()" disabled>Approve</button>
                                                        <button type="button" class="btn btn-danger" id="submitBtn" onclick="rejectForm()" >Reject</button>
                                                        <button type="button" class="btn btn-primary" id="copyBtn" style="display: none;" onclick="copyDetails()">Copy Details</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php } ?>
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

function generateDetails() {
            var emailField = document.getElementById('val-email');
            var usernameField = document.getElementById('val-username');
            var passwordField = document.getElementById('val-password');
            var submitBtn = document.getElementById('submitBtn');
            var copyBtn = document.getElementById('copyBtn');

            // var currentYear = new Date().getFullYear();
            var usernamePrefix = 'TCH';
            getUnusedUsernameSuffix(usernamePrefix);
        }

        function getUnusedUsernameSuffix(usernamePrefix) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'getUnusedUsernameSuffixtea.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var suffix = xhr.responseText;
                    document.getElementById('val-username').value = usernamePrefix + suffix;
                    document.getElementById('val-password').value = generateRandomPassword();

                    document.getElementById('submitBtn').disabled = false;
                    document.getElementById('copyBtn').style.display = 'inline';
                }
            };

            xhr.send('usernamePrefix=' + encodeURIComponent(usernamePrefix));
        }

        function generateRandomPassword() {
            // Generate a random 4-digit number
            var randomDigits = Math.floor(1000 + Math.random() * 9000);

            // Get the current year
            var currentYear = new Date().getFullYear();

            // Generate a random 3-letter string
            var randomLetters = generateRandomLetters(3);

            // Concatenate the components to form the password
            var password = randomDigits + 't' + currentYear + randomLetters;

            return password;
        }

        function generateRandomLetters(length) {
            var letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var randomString = '';
            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * letters.length);
                randomString += letters.charAt(randomIndex);
            }
            return randomString;
        }

        function copyDetails() {
            var usernameField = document.getElementById('val-username');
            var passwordField = document.getElementById('val-password');

            // Create a temporary textarea element to copy the text
            var tempTextarea = document.createElement('textarea');
            tempTextarea.value = "Dear Lecturer,\n\nWe trust this email finds you well. As part of our onboarding process, we are delighted to provide you with your login credentials for accessing our teacher portal. Please find the details below:\n\nUsername: " + usernameField.value + "\nPassword: " + passwordField.value + "\n\nLogin Path: [URL or specific instructions to access the student portal]\n\nTo log in, please follow the steps outlined below:\n\n1. Go to the provided login path..\n2. Enter your assigned username and password.\n3. Upon successful login, you will be directed to your teacher/lecturer dashboard.\n\nOnce logged in, you will have access to the tools and resources necessary for managing your courses and engaging with your students.\n\nIf you encounter any difficulties during the login process or require support, our dedicated technical team is available to assist. Feel free to contact them at [SupportEmail] or [SupportPhone].\n\nThank you for being a part of Advance LMS. We appreciate your commitment to education, and we look forward to a successful collaboration.\n\nBest regards,\n[Your Name]\n[Your Position]";
            document.body.appendChild(tempTextarea);

            // Select the text in the textarea
            tempTextarea.select();
            tempTextarea.setSelectionRange(0, 99999); // For mobile devices

            // Copy the selected text
            document.execCommand('copy');
            document.body.removeChild(tempTextarea);

            alert('Details copied to clipboard!');
        }


            function submitForm() {
                var formData = new FormData($('#teacherForm')[0]);

                $.ajax({
                    type: 'POST',
                    url: 'update_teacherrh.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert(result.message);
                        } else {
                            alert('Error: ' + result.message);
                        }
                    },
                    error: function() {
                        alert('Error: Unable to communicate with the server.');
                    }
                });
            }

            function rejectForm() {
                var formData = new FormData($('#teacherForm')[0]);

                $.ajax({
                    type: 'POST',
                    url: 'reject_teacher.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert(result.message);
                        } else {
                            alert('Error: ' + result.message);
                        }
                    },
                    error: function() {
                        alert('Error: Unable to communicate with the server.');
                    }
                });
            }
        </script>

        <script>
            function downloadCertificate(filename) {
                var url = './upload/certificates/ecteacher/' + filename;
                var link = document.createElement('a');
                link.href = url;
                link.download = filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        </script>
                <script>
            function downloadCV(filename) {
                var url = './upload/cv/ecteacher/' + filename;
                var link = document.createElement('a');
                link.href = url;
                link.download = filename;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        </script>
        <script src="plugins/common/common.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/gleek.js"></script>
        <script src="js/styleSwitcher.js"></script>

    </body>

</html><?php } ?>