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
        .card-body, .card , .gradient-1{
            border-radius: 35px;
        }

        .card , .gradient-1{
            background-color: #F9F2EF;
            width: 250px;
        }

        .card-body{
            min-width: 150px;
            background-color: #F9F2EF;
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

        .btn + .btn {
            margin-left: 10px;
        }

        .container-fluid .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; 
        }

        .col-lg-3, .col-sm-6{
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

        .col-lg-2, .col-md-3, .col-sm-6{
            padding-right: 5px;
            padding-left: 5px;
        }

        .col-12{
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
            .container-fluid .row .col-lg-2, .container-fluid .row .col-md-3 {
                flex: 0 0 calc(25% - 20px); 
                max-width: calc(25% - 20px);
                margin-bottom: 20px;
            }
        }

        @media (max-width: 1023px) {
            .container-fluid .row .col-lg-2, .container-fluid .row .col-md-3, .container-fluid .row .col-sm-6 {
                flex: 0 0 calc(50% - 20px); 
                max-width: calc(50% - 20px);
                margin-bottom: 20px;
            }
        }

        @media (max-width: 576px) {
            .container-fluid .row .col-lg-2, .container-fluid .row .col-md-3, .container-fluid .row .col-sm-6 {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 20px;
            }
        }
        
  </style>
</head>
<body><br/><br/><br/><br/>
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <h3>Accommodations in your area:</h3>

                    <div class="container-fluid mt-3">
                        <div class="row">

                            <div class="col-lg-3 col-sm-6">
                                <div class="card gradient-1">
                                    <a href="./accomodation_view.php?acom_id=<?php echo "testing"; ?>" style="text-decoration: none;">
                                        <div class="card-body">
                                            <?php
                                                $imageSource = "../images/assignment.png";
                                                echo "<img src='$imageSource' style='width: 140px; height: 90px; margin-left: 0;' alt='Image'>"; ?><br>
                                                <h5>Title goes here</h5>
                                                <p>Testing description goes here and this is testing.</p>
                                                
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card gradient-1">
                                    <a href="./accomodation_view.php?acom_id=<?php echo "testing"; ?>" style="text-decoration: none;">
                                        <div class="card-body">
                                            <?php
                                                $imageSource = "../images/assignment.png";
                                                echo "<img src='$imageSource' style='width: 140px; height: 90px; margin-left: 0;' alt='Image'>"; ?><br>
                                                <h5>Title goes here</h5>
                                                <p>Testing description goes here and this is testing.</p>
                                                
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card gradient-1">
                                    <a href="./accomodation_view.php?acom_id=<?php echo "testing"; ?>" style="text-decoration: none;">
                                        <div class="card-body">
                                            <?php
                                                $imageSource = "../images/assignment.png";
                                                echo "<img src='$imageSource' style='width: 140px; height: 90px; margin-left: 0;' alt='Image'>"; ?><br>
                                                <h5>Title goes here</h5>
                                                <p>Testing description goes here and this is testing.</p>
                                                
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="card gradient-1">
                                    <a href="./accomodation_view.php?acom_id=<?php echo "testing"; ?>" style="text-decoration: none;">
                                        <div class="card-body">
                                            <?php
                                                $imageSource = "../images/assignment.png";
                                                echo "<img src='$imageSource' style='width: 140px; height: 90px; margin-left: 0;' alt='Image'>"; ?><br>
                                                <h5>Title goes here</h5>
                                                <p>Testing description goes here and this is testing.</p>
                                                
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- Repeat the same structure for other cards -->

                        </div>
                    </div>

                    <div class="custom-card">
                        <a href="#" class="custom-btn custom-btn-primary">Show More>></a>
                    </div><br>

                    <h3>Courses and Exercises</h3>

                    <div class="container-fluid mt-1" style="justify-content: flex-start; padding: 0 0 0 0;">
                        <div class="row" style="justify-content: flex-start; max-width: 100%;">

                            <div class="col-lg-1 col-md-3 col-sm-6" style="margin-bottom: 10px; margin-right: 0; max-width: 450px; min-width: 245px;">
                                <a href="./accomodation_view.php?acom_id=<?php echo "testing"; ?>" style="text-decoration: none;">
                                    <div class="card-body" style="overflow: hidden; max-height: 250px;">
                                        <?php
                                        $imageSource = "./image.jpeg";
                                        echo "<img src='$imageSource' style='max-width: 200px; max-height: 120px; margin-left: 0;' alt='Image'>"; ?><br>
                                        <h6>This is a testing title and 12345 and counting. This is a testing title and 12345 and counting.  </h6>
                                        <div style="max-height: 8vh; overflow: hidden;">
                                            Testing description goes here and this is testing. This is testing. This is testing.
                                            This is testing.
                                            This is testing.
                                            This is testing.
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-1 col-md-3 col-sm-6" style="margin-bottom: 10px; max-width: 450px; min-width: 245px;">
                                <a href="./accomodation_view.php?acom_id=<?php echo "testing"; ?>" style="text-decoration: none;">
                                    <div class="card-body" style="overflow: hidden;">
                                        <?php
                                        $imageSource = "../images/assignment.png";
                                        echo "<img src='$imageSource' style='max-width: 200px; max-height: 120px; margin-left: 0;' alt='Image'>"; ?><br>
                                        <h5>Title goes here</h5>
                                        <div style="max-height: 8vh; overflow: hidden;">
                                            Testing description goes here and this is testing. This is testing. This is testing.
                                            This is testing.
                                            This is testing.
                                            This is testing.
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-1 col-md-3 col-sm-6" style="margin-bottom: 10px; max-width: 450px; min-width: 245px;">
                                <a href="./accomodation_view.php?acom_id=<?php echo "testing"; ?>" style="text-decoration: none;">
                                    <div class="card-body" style="overflow: hidden;">
                                        <?php
                                        $imageSource = "../images/assignment.png";
                                        echo "<img src='$imageSource' style='max-width: 200px; max-height: 120px; margin-left: 0;' alt='Image'>"; ?><br>
                                        <h5>Title goes here</h5>
                                        <div style="max-height: 8vh; overflow: hidden;">
                                            Testing description goes here and this is testing. This is testing. This is testing.
                                            This is testing.
                                            This is testing.
                                            This is testing.
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-1 col-md-3 col-sm-6" style="margin-bottom: 10px; max-width: 450px; min-width: 245px;">
                                <a href="./accomodation_view.php?acom_id=<?php echo "testing"; ?>" style="text-decoration: none;">
                                    <div class="card-body" style="overflow: hidden;">
                                        <?php
                                        $imageSource = "../images/assignment.png";
                                        echo "<img src='$imageSource' style='max-width: 200px; max-height: 120px; margin-left: 0;' alt='Image'>"; ?><br>
                                        <h5>Title goes here</h5>
                                        <div style="max-height: 8vh; overflow: hidden;">
                                            Testing description goes here and this is testing. This is testing. This is testing.
                                            This is testing.
                                            This is testing.
                                            This is testing.
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-1 col-md-3 col-sm-6" style="margin-bottom: 10px; max-width: 450px; min-width: 245px;">
                                <a href="./accomodation_view.php?acom_id=<?php echo "testing"; ?>" style="text-decoration: none;">
                                    <div class="card-body" style="overflow: hidden;">
                                        <?php
                                        $imageSource = "../images/assignment.png";
                                        echo "<img src='$imageSource' style='max-width: 200px; max-height: 120px; margin-left: 0;' alt='Image'>"; ?><br>
                                        <h6>This is a testing title and 12345 and counting</h6>
                                        <div style="max-height: 8vh; overflow: hidden;">
                                            Testing description goes here and this is testing.
                                            
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Repeat the same structure for other cards -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
arrange this codes properly