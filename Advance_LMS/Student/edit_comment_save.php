<?php include('config/constant.php'); ?>

<?php

if(isset($_POST['submit'])){

    $entry_content = $_POST['entry_content'];
    $comment_id = $_POST['comment_id'];
    $forum_id = $_POST['forum_id'];


    $sql1 = "UPDATE `tb_forum_content` SET `content`='$entry_content' WHERE `id`='$comment_id'";
    $res1 = mysqli_query($conn, $sql1);

    if($res1 == true){

        $_SESSION['edit-comment-ok'] = "OK";
        echo "<script>window.location.href = './forum_show.php?forum_id=" . $forum_id . "';</script>";

    }else{

        $_SESSION['edit-comment-error'] = "error";
        echo "<script>window.location.href = './forum_show.php?forum_id=" . $forum_id . "';</script>";
    }

}else{

}


?>