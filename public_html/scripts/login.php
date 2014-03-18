<?php 
if(!empty($_POST['userName']) && !empty($_POST['userPass'])) {
	require "../../includes/init.php";
	
	$user = $db->getRow("SELECT * FROM users WHERE username='".$_POST['userName']."' AND password='".$_POST['userPass']."' AND level>0 LIMIT 1");
	$_SESSION['userID']=$user['id'];
	
	if($_POST['userRemember']) {
		setcookie("code", md5($user['username'].$user['password'].SALT), time()+3600*24*356, '/');
	}	
}
header("Location: ../index.php");



?>
