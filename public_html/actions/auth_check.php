<?php
require "../../includes/init.php";


$response = array();

$userColumns = "id, username, firstName, lastName, lastSeen, email, level, notifyBoard";

if(isset($_SESSION['userID'])) {
	$response['access_type']="session";
} elseif(isset($_COOKIE['code'])) { 
	$user = $db->getRow("SELECT ".$userColumns." FROM users WHERE MD5(CONCAT(username,password,'".SALT."'))='".$_COOKIE['code']."' LIMIT 1");
	$response['access_type']="cookie";
} else {
	$response['status'] = 2001;
	$response['message'] = "No user authenticated";
}

if(isset($user)) {
	if(isset($user['id'])) {
		$response['status'] = 1000;
		$response['message'] = "Access as userId: " . $user['id'];
		$response['user'] = $user;
		$db->execute("UPDATE users SET lastSeen=NOW() WHERE id=".$user['id']);
		$_SESSION['userID'] = $user['id'];
	} else {
		$response['status'] = 2002;
		$response['message'] = "Invalid user";
	}
}


header('Content-Type: application/json');
echo json_encode($response);




?>