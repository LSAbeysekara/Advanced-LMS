<?php include('./config/constant.php'); ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add Product</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/logo.jpg">
    <!-- Custom Stylesheet -->
    <link href="./css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.tiny.cloud/1/ipootvjlv9vz4p1d1x91ok27oce25gt4no6r0tddj5c98lsw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
    /* Original styles */
    .conti {
        display: flex;
        flex-wrap: wrap;
    }

    .left1,
    .right1 {
        flex: 1;
        margin-right: 30px;
    }

    .left1 #map {
        width: 450px;
        height: 450px;
    }

    .location-button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }

    /* Responsive styles */
    @media (max-width: 1373px) {
        .left1 #map {
            width: 100%;
            height: 50vh;
        }
    }

    @media (max-width: 1200px) {
        .conti {
            display: flex;
            flex-wrap: wrap;
        }

        .left1,
        .right1 {
            flex: 1;
            margin-right: 20px;
        }
    }

    @media (max-width: 768px) {
        .left1,
        .right1 {
            flex: 100%;
            margin-right: 0;
        }

        .left1 #map {
            width: 100%;
            height: auto;
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

        <!--**********************************
            Content body start
        ***********************************-->

        <?php 
        if(isset($_GET['acom_id'])){

            $act_id = $_GET['acom_id'];


            $sql = "SELECT * FROM tb_courses WHERE c_id = '$act_id'";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $c_name = $row['c_name'];
                    $t_id = $row['t_id'];
                    $description = $row['description'];
                    $cou_img = $row['cou_img'];
                    $location = $row['location'];
                    $l_link = $row['l_link'];
                    $status=$row['status'];
                    
                    $sql1 = "SELECT * FROM tb_customer WHERE id = '$t_id'";

                    $res1 = mysqli_query($conn, $sql1);

                    $count1 = mysqli_num_rows($res1);

                    if($count1>0)
                    {
                        while($row=mysqli_fetch_assoc($res1))
                        {
                            $name = $row['cus_name'];
                            $email = $row['email'];
                            $phone = $row['mobile'];
                        }
                    }

                }
            } ?>

<?php

// Example location link
$locationLink = $l_link;

function extractLatLng($link) {
    // Check if the link is of the first type (contains query parameter 'q')
    if (strpos($link, 'q=') !== false) {
        $query = parse_url($link, PHP_URL_QUERY);
        parse_str($query, $params);

        if (isset($params['q'])) {
            $latLng = $params['q'];

            $latLngArray = explode(',', $latLng);

            $latitude = $latLngArray[0];
            $longitude = $latLngArray[1];

            return array(
                'latitude' => $latitude,
                'longitude' => $longitude
            );
        } else {
            return null;
        }
    } 
    // Check if the link is of the second type (contains latitude and longitude in the URL)
    elseif (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $link, $matches)) {
        $latitude = $matches[1];
        $longitude = $matches[2];

        return array(
            'latitude' => $latitude,
            'longitude' => $longitude
        );
    } 
    // If the link format is not recognized
    else {
        return null;
    }
}

$coordinates = extractLatLng($locationLink);

if ($coordinates !== null) {
    $map = "https://www.google.com/maps?q={$coordinates['latitude']},{$coordinates['longitude']}&output=embed";
} else {
    echo "Latitude and longitude not found in the location link.";
}
?>



            <div class="content-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">

                                <div class="conti">
                                    <div class="left1">
                                        <div class="media align-items-center mb-4">
                                            <div class="mr-3" id="map"></div>
                                        </div>
                                    </div>
                                    <div class="right1">
                                        <h2 style="color: #C45719;"><?php echo $c_name; ?></h2><br>
                                        
                                        <div class="media-body">
                                            <li><h4><strong class="text-dark mr-4"><?php echo $description; ?></strong></h4></br>
                                            <li><h4><strong style="color: #130C99;">Teacher's Name</strong></h4><h4>
                                                <span><?php echo $name; ?></span><br><br>
                                            </h4></li>
                                            <li><h4><strong style="color: #130C99;">Contact Details</strong></h4><h5>
                                                <span>Email: </span><span style="color: #DE6A37;"><?php echo $email; ?></span><br><br>
                                                <span>Mobile: </span><span style="color: #DE6A37;"><?php echo $phone; ?></span><br><br>
                                            </h5></li>
                                            <li><h4><strong style="color: #130C99;">Location and link</strong></h4><h5><span><?php echo $location; ?></span></h5></li>
                                            <h5><li><a href="<?php echo $l_link; ?>"><button class="location-button">Get location</button></a></li></h5>
                                        </div><br>
                                        <?php if ($status=='pending') { ?>
                                        <button type="button" class="btn btn-success" id="submitBtn" onclick="submitForm('<?php echo $act_id ?>')" >Approve</button>
                                        <button type="button" class="btn btn-danger" id="submitBtn" onclick="rejectForm('<?php echo $act_id ?>')" >Reject</button>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>  
                    </div>
                </div>
                <!-- #/ container --> 
            </div>
            <?php 
        }else{
            $_SESSION['activity-view-error'] = "Error";
            //header("Location: ./resource_hub.php");
        }
        ?>


        
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
    // Get the PHP map link
    const mapLink = "<?php echo $map; ?>";

    // Create an iframe element to embed the map
    const mapIframe = document.createElement('iframe');

    // Set attributes for the iframe
    mapIframe.setAttribute('width', '100%');
    mapIframe.setAttribute('height', '100%');
    mapIframe.setAttribute('frameborder', '0');
    mapIframe.setAttribute('style', 'border:0');
    mapIframe.setAttribute('src', mapLink);

    // Append the iframe to the map container
    document.getElementById('map').appendChild(mapIframe);
</script>
<script>

function submitForm(act_id) {
    var c_id = act_id;

    $.ajax({
        type: 'POST',
        url: 'update_courserh.php',
        data: { c_id: c_id }, // Sending data as an object
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

            function rejectForm(act_id) {
                
                var c_id = act_id;
                $.ajax({
                    type: 'POST',
                    url: 'reject_courserh.php',
                    data: { c_id: c_id },
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
    <script src="./plugins/common/common.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/settings.js"></script>
    <script src="./js/gleek.js"></script>
    <script src="./js/styleSwitcher.js"></script>

</body>

</html>






        