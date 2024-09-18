<?php
session_start();
include('config/constant.php');
if (!isset($_SESSION['teacher_name'])) {
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
} else {
    $c_id = $_GET['id'];



    if (isset($_GET['aid'])) {
        $act_id = $_GET['aid'];
        $sql = "SELECT * FROM tb_activity WHERE act_id = '$act_id'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count > 0) {

            while ($row = mysqli_fetch_assoc($res)) {
                $act_name = $row['act_name'];
                $file_name = $row['file_name'];
                $content = $row['content'];
                $deadline = $row['deadline'];
                $created = $row['created'];
                $c_id = $row['c_id'];
                $status = $row['status'];
            } ?>

    <?php
        } else {
            $_SESSION['add-error'] = "error";
            header('location: add-assignment.php');
        }
    } else {
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

        <!-- theme meta -->
        <meta name="theme-name" content="quixlab" />

        <title>View Assignment</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="images/logo.jpg">
        <!-- Pignose Calender -->
        <link href="./plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
        <!-- Chartist -->
        <link rel="stylesheet" href="./plugins/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="./plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
        <!-- Custom Stylesheet -->
        <link href="css/style.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

        <script src="https://cdn.tiny.cloud/1/ipootvjlv9vz4p1d1x91ok27oce25gt4no6r0tddj5c98lsw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

        <style>
            /* Style the table */
            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
            }

            /* Style the table header */
            th {
                background-color: #f2f2f2;
                font-weight: bold;
                text-align: left;
                padding: 8px;
                border: 1px solid #dddddd;
            }

            /* Style the table rows */
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            /* Style the table data cells */
            td {
                padding: 8px;
                border: 1px solid #dddddd;
            }

            /* Style input and textarea inside table cells */
            input[type="number"],
            textarea {
                width: 100%;
                padding: 5px;
                box-sizing: border-box;
                border: 1px solid #dddddd;
                border-radius: 4px;
            }

            /* Remove border for the last cell in each row */
            td:last-child {
                border-right: none;
            }

            /* Remove border for the last row */
            tr:last-child td {
                border-bottom: none;
            }

            .save-button {
                background-color: #4CAF50;
                /* Green */
                border: none;
                color: white;
                padding: 10px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 4px;
            }

            .save-button:hover {
                background-color: #3e8e41;
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
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3> <?php echo $act_id . ' - ' . $act_name; ?></h3>
                                    <div>
                                        <?php echo $content; ?>
                                    </div>
                                    <div>
                                        <?php
                                        $pdfFilePath = './activities/' . $file_name;
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
                                            <button type="submit" name="submit" class="save-button">Download Answers</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <h3>Grade Answers</h3>
                                    <table>
                                        <tr>
                                            <th>Student name</th>
                                            <th>Uploaded</th>
                                            <th>Grade</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>

                                        <form action="#" method="post">

                                            <?php
                                            $sql2 = "SELECT * FROM tb_submission WHERE act_id = '$act_id'";

                                            $res2 = mysqli_query($conn, $sql2);

                                            $count2 = mysqli_num_rows($res2);

                                            if ($count2 > 0) {
                                                while ($row = mysqli_fetch_assoc($res2)) {
                                                    $uplo_date = $row['uploaded_date'];
                                                    $st_username = $row['st_username'];
                                                    $grading = $row['grading'];
                                                    $comment = $row['comment'];
                                                    $status = $row['grading_status'];


                                                    $sql3 = "SELECT * FROM tb_student WHERE username = '$st_username'";

                                                    $res3 = mysqli_query($conn, $sql3);

                                                    $count3 = mysqli_num_rows($res3);

                                                    if ($count3 > 0) {
                                                        while ($row = mysqli_fetch_assoc($res3)) {
                                                            $st_name = $row['st_name'];



                                                            $sql4 = "SELECT * FROM tb_activity WHERE act_id = '$act_id'";

                                                            $res4 = mysqli_query($conn, $sql4);

                                                            $count4 = mysqli_num_rows($res4);

                                                            if ($count4 > 0) {
                                                                while ($row = mysqli_fetch_assoc($res4)) {
                                                                    $deadline = $row['deadline'];


                                            ?>

                                                                    <tr>
                                                                        <td><?php echo $st_username . " - " . $st_name; ?></td>
                                                                        <th>
                                                                            <?php
                                                                            $startDateTime = new DateTime($uplo_date);
                                                                            $endDateTime = new DateTime($deadline);

                                                                            $difference = $endDateTime->diff($startDateTime);

                                                                            $days = $difference->days;
                                                                            $hours = $difference->h;
                                                                            $minutes = $difference->i;

                                                                            $timeDifference = '';

                                                                            if ($days > 0) {
                                                                                $timeDifference .= "$days days ";
                                                                            }
                                                                            if ($hours > 0) {
                                                                                $timeDifference .= "$hours hours ";
                                                                            }
                                                                            if ($minutes > 0) {
                                                                                $timeDifference .= "$minutes minutes";
                                                                            }
                                                                            if ($days == 0 && $hours == 0 && $minutes == 0) {
                                                                                $timeDifference .= "0 minutes";
                                                                            }

                                                                            $style = '';
                                                                            if ($startDateTime > $endDateTime) {
                                                                                $style = 'color: red;';
                                                                                $beforeAfterText = 'after';
                                                                            } else {
                                                                                $beforeAfterText = 'before';
                                                                            }

                                                                            ?>

                                                                            <span style="<?php echo $style; ?>"><?php echo $timeDifference; ?> <?php echo $beforeAfterText; ?></span>

                                                                        </th>
                                                                        <td><input type="number" name="grading" value="<?php echo $grading; ?>"></td>
                                                                        <td><textarea name="comment" id="" cols="30" rows="2"><?php echo $comment; ?></textarea></td>
                                                                        <td>
                                                                            <select name="status" id="status">
                                                                                <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                                                                <option value="active">Active</option>
                                                                                <option value="inactive">Inactive</option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input type="hidden" name="act_id" value="<?php echo $act_id; ?>">
                                                                            <input type="hidden" name="username" value="<?php echo $st_username; ?>">
                                                                            <button type="button" class="save-button" onclick="saveData('<?php echo $act_id; ?>', '<?php echo $st_username; ?>', this)">Save</button>
                                                                        </td>
                                                                    </tr>

                                            <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            } ?>

                                        </form>
                                    </table>
                                </div><br>
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
        <script>
            function saveData(act_id, username, button) {
                // Navigate up the DOM tree to the row containing the button
                var row = button.parentNode.parentNode;

                // Find grading, comment, and status elements within the row
                var gradingInput = row.querySelector('input[name="grading"]');
                var commentInput = row.querySelector('textarea[name="comment"]');
                var statusSelect = row.querySelector('select[name="status"]');

                // Retrieve values from grading, comment, and status inputs
                var grading = gradingInput.value;
                var comment = commentInput.value;
                var status = statusSelect.value;

                // Create AJAX request
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText == "success") {

                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Your work has been saved",
                                showConfirmButton: false,
                                timer: 500
                            });

                            console.log("Data saved successfully");
                        } else {
                            // Handle error
                            console.log("Error saving data");
                        }
                    }
                };
                xhttp.open("POST", "update_grading_comment.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("act_id=" + act_id + "&username=" + username + "&grading=" + grading + "&comment=" + comment + "&status=" + status);
            }
        </script>


        <script src="plugins/common/common.min.js"></script>
        <script src="js/custom.min.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/gleek.js"></script>
        <script src="js/styleSwitcher.js"></script>


        <script src="./js/dashboard/dashboard-1.js"></script>

    </body>

    </html>
<?php } ?>