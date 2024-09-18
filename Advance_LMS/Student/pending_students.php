
<?php
include('config/constant.php');


$usernamea   = isset($_COOKIE['username']) ? $_COOKIE['username'] : null;


$sqld = "SELECT * FROM tb_student WHERE username = '$usernamea'";

$resd = mysqli_query($conn, $sqld);

$rows = mysqli_fetch_assoc($resd);


$_SESSION['status'] = $rows['status'];
$_SESSION['username'] = $usernamea;
?>
<?php


$username = $_SESSION['username'];
?>
<?php if ($_SESSION['status'] =="Pending"){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter your details to continue</title>
    <style>
        body {
            background-color: #F9F4F7;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        
        .floating-panel {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff; /* White background */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            height: auto;
            z-index: 9999999; /* Ensures it's above other content */
        }

        .floating-panel p,
        .floating-panel h1 {
            text-align: center;
        }

        /* Form styles */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .logout-button {
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

        .logout-button:hover {
            background-color: #0056b3;
        }

        button.logout-button:hover {
            background-color: #DFCB22;
        }
    </style>
</head>
<body>
    <div class="floating-panel">
        <h1>Enter Your Details</h1>
        <form action="add_student_details.php" method="post">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
                <label for="nic">NIC:</label>
                <input type="text" id="nic" name="nic" placeholder="Enter your NIC number" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number:</label>
                <input type="text" id="mobile" name="mobile" placeholder="Enter your mobile number" pattern="[0-9]{9}" title="Please enter a 10-digit mobile number" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" placeholder="Enter your address" required></textarea>
            </div>
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <a href="logout.php">
        <button class="logout-button">Logout</button>
    </a>
</body>
</html>
<?php } else if($_SESSION['status'] =="Active"){ 
    echo "<script> window.location.replace('http://localhost:8080/Advance_LMS/Student/index.php'); </script>";
}else{
    echo "<script> window.location.replace('http://localhost:3000/login'); </script>";
}

?>