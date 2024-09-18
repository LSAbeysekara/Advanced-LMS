<?php
session_start();
unset($_SESSION['admin_name']);
unset($_SESSION['admin_id']);
unset($_SESSION['user_type']);
setcookie('admin_name', null, time() - 3600, '/');
setcookie('user_type', null, time() - 3600, '/');
setcookie('admin_id', null, time() - 3600, '/');
header("Location:index.php");
?>