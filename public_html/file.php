<?php

$fileId = $_GET['id'];
if(empty($fileId)) die("Error: no file id specified");


require "../includes/init.php";
$file = $db->getRow("SELECT * FROM files WHERE file_id=? LIMIT 1", array($fileId));

$uri = ROOT."files/".$file['hash'];

$pathParts = pathinfo($file['filename']);
if(is_file($uri)) {
	switch(strtolower($pathParts['extension'])) {
		case "jpg": case "jpeg":
		header('Content-Type: image/jpeg');
		break;
		
		case "png":
		header('Content-Type: image/png');
		break;
	}
	

	readfile($uri);	
} else {
	die("file not found (" . $uri . ")");
}


?>