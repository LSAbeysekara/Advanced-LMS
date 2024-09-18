<?php include('../config/constant.php'); ?>

<?php

?>

<?php

if (isset($_GET['district'])) {

    $location = $_GET['district']; ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="../images/logo.jpg">
        <!-- Pignose Calendar -->
        <link href="../plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
        <!-- Chartist -->
        <link rel="stylesheet" href="../plugins/chartist/css/chartist.min.css">
        <link rel="stylesheet" href="../plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
        <!-- Custom Stylesheet -->
        <link href="../css/style.css" rel="stylesheet">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

        <style>
            .cont {
                display: flex;
            }

            .left,
            .right {
                flex: 1;
                margin-right: 20px;
            }

            .card-body,
            .card,
            .gradient-1 {
                border-radius: 35px;
                background-color: #F9F2EF;
            }

            .card {
                width: 250px;
            }

            .card-body {
                min-width: 150px;
                color: black;
            }

            .btn {
                display: inline-block;
                padding: 10px 20px;
                font-size: 16px;
                font-weight: bold;
                color: #fff;
                background-color: #007bff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .btn:hover {
                background-color: #0056b3;
            }

            .btn:focus {
                outline: none;
                box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.4);
            }

            .btn:active {
                transform: translateY(1px);
            }

            .btn+.btn {
                margin-left: 10px;
            }

            .container-fluid .row {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .col-lg-3,
            .col-sm-6 {
                text-align: center;
            }

            .custom-card {
                border-radius: 10px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;
                margin-top: 20px;
            }

            .custom-card-body {
                padding: 20px;
            }

            .custom-card-title {
                font-size: 1.2rem;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .custom-card-text {
                color: #666;
                margin-bottom: 20px;
            }

            .custom-btn-primary {
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                padding: 8px 16px;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

            .custom-btn-primary:hover {
                background-color: #34738B;
                color: white;
                text-decoration: none;
            }

            .col-lg-2,
            .col-md-3,
            .col-sm-6 {
                padding-right: 5px;
                padding-left: 5px;
            }

            .col-12 {
                padding-right: 5px;
                width: 100%;
            }

            @media (max-width: 1350px) {
                .container-fluid .row .col-lg-3:nth-child(n+5) {
                    display: none;
                }
            }

            @media (max-width: 1334px) {
                .container-fluid .row .col-lg-3:nth-child(n+4) {
                    display: none;
                }
            }

            @media (max-width: 990px) {
                .container-fluid .row .col-lg-3:nth-child(n+3) {
                    display: none;
                }
            }

            @media (max-width: 834px) {
                .container-fluid .row .col-lg-3:nth-child(n+2) {
                    display: none;
                }
            }

            @media (max-width: 1275px) {
                .container-fluid .row .col-lg-2 {
                    flex: 0 0 calc(20% - 20px);
                    max-width: calc(20% - 20px);
                    margin-bottom: 20px;
                }
            }

            @media (max-width: 1198px) {

                .container-fluid .row .col-lg-2,
                .container-fluid .row .col-md-3 {
                    flex: 0 0 calc(25% - 20px);
                    max-width: calc(25% - 20px);
                    margin-bottom: 20px;
                }
            }

            @media (max-width: 1023px) {

                .container-fluid .row .col-lg-2,
                .container-fluid .row .col-md-3,
                .container-fluid .row .col-sm-6 {
                    flex: 0 0 calc(50% - 20px);
                    max-width: calc(50% - 20px);
                    margin-bottom: 20px;
                }
            }

            @media (max-width: 576px) {

                .container-fluid .row .col-lg-2,
                .container-fluid .row .col-md-3,
                .container-fluid .row .col-sm-6 {
                    flex: 0 0 100%;
                    max-width: 100%;
                    margin-bottom: 20px;
                }
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


            <div class="content-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <h3>Accommodations in your area:</h3>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="searchInput" name="search" placeholder="Search accommodation here..." required><br>
                                </div>
                            </div>

                            <div class="container-fluid mt-1" style="justify-content: flex-start; padding: 0 0 0 0; margin-bottom: 30px;">
                                <div class="row" id="searchResults" style="justify-content: flex-start; max-width: 100%;">

                                    <?php

                                    $sql2 = "SELECT * FROM tb_courses WHERE c_type = 'acom' AND location = '$location' AND status = 'active'";

                                    $res2 = mysqli_query($conn, $sql2);

                                    $count2 = mysqli_num_rows($res2);

                                    if ($count2 > 0) {
                                        while ($row = mysqli_fetch_assoc($res2)) {
                                            $co_id = $row['c_id'];
                                            $cus_id = $row['t_id'];
                                            $title01 = $row['c_name'];
                                            $image01 = $row['cou_img'];
                                            $description01 = $row['description'];


                                            $sql3 = "SELECT * FROM tb_customer WHERE id = '$cus_id'";

                                            $res3 = mysqli_query($conn, $sql3);

                                            $count3 = mysqli_num_rows($res3);

                                            if ($count3 > 0) {
                                                while ($row = mysqli_fetch_assoc($res3)) {
                                                    $status01 = $row['status'];
                                                }
                                            }

                                            if ($status01 == 'Active') { ?>

                                                <div class="col-lg-1 col-md-3 col-sm-6" style="margin-bottom: 10px; margin-right: 0; max-width: 450px; min-width: 245px;">
                                                    <a href="./accomodation_view.php?acom_id=<?php echo $co_id; ?>" style="text-decoration: none;">
                                                        <div class="card-body" style="overflow: hidden; max-height: 272px; min-height: 270px;">
                                                            <?php
                                                            $imageSource = "./images/accomodation/" . $image01;
                                                            echo "<img src='$imageSource' style='max-width: 200px; max-height: 122px; min-height: 120px; margin-left: 0;' alt='Image'>"; ?><br>
                                                            <h6><?php echo $title01; ?></h6>
                                                            <div style="max-height: 10vh; overflow: hidden;"><?php echo $description01; ?></div>
                                                        </div>
                                                    </a>
                                                </div>

                                            <?php
                                            } ?>
                                    <?php
                                        }
                                    } ?>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
  
        <script>
            // Store the initial cards markup
            var initialCardsMarkup = document.getElementById("searchResults").innerHTML.trim();

            // Function to perform AJAX request for search
            function searchCourses() {
                var searchQuery = document.getElementById('searchInput').value;
                var location = '<?php echo $location; ?>'; // Get the PHP variable $location

                // If search query is empty, restore initial cards markup
                if (searchQuery === '') {
                    document.getElementById("searchResults").innerHTML = initialCardsMarkup;
                    return;
                }

                // Send AJAX request for search
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4) {
                        if (this.status == 200) {
                            var searchResults = JSON.parse(this.responseText);
                            displaySearchResults(searchResults);
                        } else {
                            console.error("Error fetching search results: ", this.status);
                        }
                    }
                };
                xhr.open("GET", "search_acom.php?query=" + searchQuery + "&location=" + location, true); // Pass location as a parameter
                xhr.send();
            }

            // Function to display search results
            function displaySearchResults(results) {
                var searchResultsContainer = document.getElementById("searchResults");
                // Clear previous search results
                searchResultsContainer.innerHTML = "";

                // Generate HTML for each search result
                results.forEach(function(result) {
                    var cardHtml = '<div class="col-lg-1 col-md-3 col-sm-6" style="margin-bottom: 10px; margin-right: 0; max-width: 450px; min-width: 245px;">';
                    cardHtml += '<a href="./accomodation_view.php?acom_id=' + result.c_id + '" style="text-decoration: none;">';
                    cardHtml += '<div class="card-body" style="overflow: hidden; max-height: 250px; min-height: 230px;">';
                    cardHtml += '<img src="./images/accomodation/' + result.cou_img + '" style="max-width: 200px; max-height: 122px; min-height: 120px; margin-left: 0;" alt="Image"><br>';
                    cardHtml += '<h6>' + result.c_name + '</h6>';
                    cardHtml += '<div style="max-height: 8vh; overflow: hidden;">' + result.description + '</div>';
                    cardHtml += '</div></a></div>';

                    // Append the HTML to the search results container
                    searchResultsContainer.innerHTML += cardHtml;
                });
            }

            // Attach event listener to the search input field
            document.getElementById('searchInput').addEventListener('input', function() {
                searchCourses();
            });
        </script>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="../plugins/common/common.min.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/gleek.js"></script>
    <script src="../js/styleSwitcher.js"></script>

    </body>

    </html>

<?php } else {
    $_SESSION['location-get-error'] = "Error";
    header("Location: ./index.php");
} ?>