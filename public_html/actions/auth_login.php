<?php
require "../../includes/init.php";


$response = array();



$user = Gatekeeper::login($_POST['userName'], $_POST['userPass'], $db, $_POST['userRemember']);


if(isset($user['id'])) {
	$response['status'] = 1000;
	$response['message'] = "Login as userId: " . $user['id'];
	$response['user'] = $user;
	$db->execute("UPDATE users SET lastSeen=NOW() WHERE id=".$user['id']);
	
} else {
	$response['status'] = 2003;
	$response['message'] = "Access denied";
}


header('Content-Type: application/json');
echo json_encode($response);




?>