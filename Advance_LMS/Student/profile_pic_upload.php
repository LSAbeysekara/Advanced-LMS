<?php
include('config/constant.php');

$username = "B2024000002";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Picture Upload</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #F9F4F7;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            height: auto;
            text-align: center;
        }

        .profile-picture {
            width: 250px;
            height: 250px;
            border: 1px solid;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            position: relative;
        }

        .profile-picture input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .skip-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 8px 16px;
            width: 100px;
            background-color: #FC4817;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .skip-button:hover {
            background-color: #0056b3;
        }

        .submit {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        .submit:hover {
            background-color: #0056b3;
        }

        .placeholder-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #888;
            font-size: 14px;
            pointer-events: none;
        }

        /* Responsive styling */
        @media only screen and (max-width: 768px) {
            .container {
                padding: 10px;
                max-width: 100%;
            }
            .profile-picture {
                width: 200px;
                height: 200px;
            }
            .submit,
            .skip-button {
                width: 80px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Select Profile Picture</h2>
        <form id="uploadForm" action="pro_pic_upload.php" method="post" enctype="multipart/form-data">
            <div class="profile-picture">
                <input type="file" name="profile_pic" id="profile_pic" accept=".jpg, .jpeg, .png" onchange="previewImage(event)">
                <label for="profile_pic" id="placeholderText" class="placeholder-text">Click here to add a profile picture</label>
                <img id="preview" src="#" alt="Preview">
            </div>

            <input type="hidden" name="username" value="<?php echo $username; ?> ">

            <button class="submit" type="submit" name="submit" disabled>Confirm</button>
        </form>
    </div>

    <a href="index.php">
        <button class="skip-button">Skip</button>
    </a>

    <script>
        function previewImage(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('preview');
                output.src = reader.result;
                document.getElementById('placeholderText').style.display = 'none'; // Hide placeholder text when image is selected
                document.querySelector('.submit').disabled = false; // Enable the submit button
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>
</body>
</html>
