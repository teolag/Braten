<?php 
define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/../');
session_start();

setlocale(LC_TIME, 'sv_SV', 'swedish');
require "config.php";
require "functions.php";

define("SALT", $config['salt']);

$db = new DatabasePDO($config["db"]["server"], $config["db"]["username"], $config["db"]["password"], $config["db"]["name"]);



if(!empty($_SESSION['userID'])) $user = $db->getRow("SELECT * FROM users WHERE id=".intval($_SESSION['userID'])." LIMIT 1");
elseif(!empty($_COOKIE['code'])) $user = $db->getRow("SELECT * FROM users WHERE MD5(CONCAT(username,password,'".SALT."'))='".$_COOKIE['code']."' LIMIT 1");

if(!$public) {
	if(isset($user['id'])) {
		$db->execute("UPDATE users SET lastSeen=NOW() WHERE id=".$user['id']);
		$_SESSION['userID'] = $user['id'];
	}
	elseif(empty($user['id']) && $page!="login") {
		header("location: login.php");
		exit;
	}
}



$owners = array("Mats", "Gunilla", "Eva");


?>