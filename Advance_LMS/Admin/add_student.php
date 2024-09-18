<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if (!isset($_SESSION['admin_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/admin'); </script>";
} else {
    
    ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Student</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>
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
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Student</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Student</a></li>
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
                                    <form class="form-valide" method="post" id="myForm">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-email">Email <span class="text-danger">*</span></label>
                                            <div class="col-lg-6">
                                                <input type="email" class="form-control" id="val-email" name="val-email" placeholder="Your valid email.." required><span id="emailMessage" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="button" class="btn btn-primary" onclick="checkEmailAndGenerate()">Generate</button>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-username">Username <span class="text-danger"></span></label>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control" id="val-username" name="val-username" required readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="val-password">Password <span class="text-danger"></span></label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control" id="val-password" name="val-password" readonly required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-8 ml-auto">
                                                <button type="submit" class="btn btn-primary" id="submitBtn" onclick="submitForm()" disabled>Submit</button>
                                                <button type="button" class="btn btn-primary" id="copyBtn" style="display: none;" onclick="copyDetails()">Copy Details</button>
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
        function checkEmailAndGenerate() {
            var emailField = document.getElementById('val-email');
            var emailMessage = document.getElementById('emailMessage');
            var generateButton = document.querySelector('button[type="button"]');

            // Reset previous error message
            emailMessage.textContent = '';

            var emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailFormat.test(emailField.value)) {
                emailMessage.textContent = 'Valied Email is required.';
                emailField.focus();
                return;
            }

            // Perform AJAX request to check email existence
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'checkEmailExists.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === 'exists') {
                            emailMessage.textContent = 'Email already exists in the database.';
                            generateButton.disabled = false;
                        } else {
                            generateButton.disabled = false;
                            generateDetails();
                        }
                    } else {
                        console.error('Error checking email existence');
                    }
                }
            };

            // Send email value to check
            xhr.send('email=' + encodeURIComponent(emailField.value));
        }

        function generateDetails() {
            var emailField = document.getElementById('val-email');
            var usernameField = document.getElementById('val-username');
            var passwordField = document.getElementById('val-password');
            var submitBtn = document.getElementById('submitBtn');
            var copyBtn = document.getElementById('copyBtn');

            var currentYear = new Date().getFullYear();
            var usernamePrefix = 'B' + currentYear;
            getUnusedUsernameSuffix(usernamePrefix);
        }

        function getUnusedUsernameSuffix(usernamePrefix) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'getUnusedUsernameSuffix.php', true);
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
            var password = randomDigits + 'B' + currentYear + randomLetters;

            return password;
        }
        // function copyDetails() {
        //     var usernameField = document.getElementById('val-username');
        //     var passwordField = document.getElementById('val-password');

        //     // Create a temporary textarea element to copy the text
        //     var tempTextarea = document.createElement('textarea');
        //     tempTextarea.value = "Username: " + usernameField.value + "\nPassword: " + passwordField.value;
        //     document.body.appendChild(tempTextarea);

        //     // Select the text in the textarea
        //     tempTextarea.select();
        //     tempTextarea.setSelectionRange(0, 99999); // For mobile devices

        //     // Copy the selected text
        //     document.execCommand('copy');
        //     document.body.removeChild(tempTextarea);

        //     alert('Details copied to clipboard!');
        // }
        function copyDetails() {
            var usernameField = document.getElementById('val-username');
            var passwordField = document.getElementById('val-password');

            // Create a temporary textarea element to copy the text
            var tempTextarea = document.createElement('textarea');
            tempTextarea.value = "Dear Student,\n\nWe hope this email finds you well. As part of our enrollment process, we are pleased to provide you with your login credentials for accessing our student portal. Below are the details:\n\nUsername: " + usernameField.value + "\nPassword: " + passwordField.value + "\n\nLogin Path: [URL or specific instructions to access the student portal]\n\nPlease follow the steps below to log in:\n\n1. Navigate to the provided login path.\n2. Enter your assigned username and password.\n3. Upon successful login, you will be directed to your student dashboard.\n\nAfter logging in, we kindly request you to complete the remaining details in your profile. This information is crucial for us to ensure accurate records and to enhance your overall experience.\n\nShould you encounter any issues during the login process or require assistance, please do not hesitate to reach out to our support team at [SupportEmail] or [SupportPhone].\n\nThank you for choosing us. We look forward to having you as part of our academic community.\n\nBest regards,\n[Your Name]\n[Your Position]";
            document.body.appendChild(tempTextarea);

            // Select the text in the textarea
            tempTextarea.select();
            tempTextarea.setSelectionRange(0, 99999); // For mobile devices

            // Copy the selected text
            document.execCommand('copy');
            document.body.removeChild(tempTextarea);

            alert('Details copied to clipboard!');
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

        function submitForm() {
            var emailField = $('#val-email').val();
            var usernameField = $('#val-username').val();
            var passwordField = $('#val-password').val();

            // Validate email
            if (emailField === '') {
                alert('Email is required.');
                $('#val-email').focus();
                return;
            }

            // Validate generated username and password
            if (usernameField === '' || passwordField === '') {
                alert('Please click the "Generate" button to generate username and password.');
                return;
            }

            // Prepare data to send
            var formData = {
                email: emailField,
                username: usernameField,
                password: passwordField
            };

            // Send data to the server using jQuery AJAX
            $.ajax({
                type: 'POST',
                url: 'saveStudentDetails.php',
                data: formData,
                success: function(data) {
                    // Process the response from the server
                    if ($.trim(data) === 'success') {
                        // Success, dynamically generate success message
                        var successMessage = generateSuccessMessage(usernameField, passwordField);

                        // Display the success message in an alert
                        alert(successMessage);

                        // Copy the message to the clipboard
                        copyToClipboard(successMessage);
                    } else {
                        // Error, show error message received from the server
                        alert('Error: ' + data);
                    }
                },
                error: function(error) {
                    // Error, show error message
                    alert('Error saving student details. ' + error.statusText);
                }
            });
        }

        function generateSuccessMessage(username, password) {
            // Customize this message based on your requirements
            return "Dear Student,\n\nWe hope this email finds you well. As part of our enrollment process, we are pleased to provide you with your login credentials for accessing our student portal. Below are the details:\n\nUsername: " + username + "\nPassword: " + password + "\n\nLogin Path: [URL or specific instructions to access the student portal]\n\nPlease follow the steps below to log in:\n\n1. Navigate to the provided login path.\n2. Enter your assigned username and password.\n3. Upon successful login, you will be directed to your student dashboard.\n\nAfter logging in, we kindly request you to complete the remaining details in your profile. This information is crucial for us to ensure accurate records and to enhance your overall experience.\n\nShould you encounter any issues during the login process or require assistance, please do not hesitate to reach out to our support team at [SupportEmail] or [SupportPhone].\n\nThank you for choosing us. We look forward to having you as part of our academic community.\n\nBest regards,\n[Your Name]\n[Your Position]";
        }


        function copyToClipboard(text) {
            var textarea = document.createElement("textarea");
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);

            Swal.fire('Copied!', 'Message has been copied to the clipboard', 'success');
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