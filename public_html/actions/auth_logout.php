<?php 
require "../../includes/init.php";

$response = array("status"=>1000, "message"=>"Logged out");

Gatekeeper::logout();



header('Content-Type: application/json');
echo json_encode($response);

?>