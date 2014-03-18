<?php 
session_start();

unset($_SESSION['userID']);
setcookie("code", NULL, time()-666, '/');

header("Location: ../login.php");


?>