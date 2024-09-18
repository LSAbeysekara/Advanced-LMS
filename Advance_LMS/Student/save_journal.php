<?php include('config/constant.php'); 
session_start();?>

<?php $username = $_SESSION['username']; ?> 

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
 
    if (!empty($_POST["entry_content"])) {

        $title = $_POST["title"];
        $entry_content = $_POST["entry_content"];
        $status = "Active";

        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');

        $sql = "INSERT INTO tb_forum SET
            title = '$title',
            content = '$entry_content',
            created_dt = '$currentDateTime',
            created_by = '$username',
            status = '$status'
        ";
        $res = mysqli_query($conn, $sql);


        if($res == true){

            $_SESSION['add-forum-ok'] = "OK";
            header("Location: ./journal_form.php");

        }
        else
        {
            $_SESSION['add-forum-error'] = "Error";
            header("Location: ./journal_form.php");
            exit;
        }

    } else {
        
        $_SESSION['add-forum-error'] = "Error";
        header("Location: ./journal_form.php");
        exit;
    }
} else {
    $_SESSION['add-forum-error'] = "Error";
    header("Location: ./journal_form.php");
    exit;
}
?>
