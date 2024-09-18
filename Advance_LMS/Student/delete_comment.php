<?php include('config/constant.php'); ?>

<?php

if (isset($_GET['comment_id']) && $_GET['forum_id']) {

    $comment_id = $_GET['comment_id'];
    $forum_id = $_GET['forum_id'];

}else{

    $_SESSION['delete-comment-error'] = "Error";
    header("Location: ./forum_show.php?forum_id= " . $forum_id);
    exit;
}


$sql = "DELETE FROM tb_forum_content WHERE id='$comment_id'";
$res = mysqli_query($conn, $sql);

if($res==true)
{
    $_SESSION['delete-comment-ok'] = "OK";
    header('location:./forum_show.php?forum_id= '.$forum_id);
}
else
{
    header('location:'.SITEURL.'./forum_show.php?forum_id='.$forum_id);
}

?>