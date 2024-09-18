<?php
session_start();
unset($_SESSION['teacher_name']);
unset($_SESSION['tchr_id']);
unset($_SESSION['user_type']);
setcookie('teacher_name', null, time() - 3600, '/');
setcookie('user_type', null, time() - 3600, '/');
setcookie('tchr_id', null, time() - 3600, '/');
header("Location:index.php");
?>