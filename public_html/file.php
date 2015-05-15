<?php

$fileId = $_GET['id'];
if(empty($fileId)) die("Error: no file id specified");


require "../includes/init.php";
$file = $db->getRow("SELECT * FROM files WHERE file_id=? LIMIT 1", array($fileId));

$uri = ROOT."files/".$file['hash'];
if(is_file($uri)) {
	readfile($uri);	
} else {
	die("file not found (" . $uri . ")");
}


?>