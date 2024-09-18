<?php include('config/constant.php'); ?>

<?php $username = $_SESSION['username'];?> 

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
 
    if (!empty($_POST["comment"])) {

        $comment = $_POST["comment"];
        $forum_id = $_POST["forum_id"];
        $status = "Active";

        date_default_timezone_set('Asia/Colombo');
        $currentDateTime = date('Y-m-d H:i:s');

        $sql = "INSERT INTO tb_forum_content SET
            forum_id = '$forum_id',
            content = '$comment',
            created_dt = '$currentDateTime',
            posted_by = '$username',
            status = '$status'
        ";
        $res = mysqli_query($conn, $sql);


        if($res == true){

            $_SESSION['add-comment-ok'] = "OK";
            header("Location: ./forum_show.php?forum_id=" . $forum_id);

        }
        else
        {
            $_SESSION['add-comment-error'] = "Error";
            header("Location: ./forum_show.php?forum_id=" . $forum_id);
            exit;
        }

    } else {
        
        $_SESSION['add-comment-error'] = "Error";
        header("Location: ./forum_show.php?forum_id=" . $forum_id);
        exit;
    }
} else {
    $_SESSION['add-comment-error'] = "Error";
    header("Location: ./forum_show.php?forum_id=" . $forum_id);
    exit;
}
?>
