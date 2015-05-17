<?php

$fileId = $_GET['id'];
if(empty($fileId)) die("Error: no file id specified");


require "../includes/init.php";
$file = $db->getRow("SELECT * FROM files WHERE file_id=? LIMIT 1", array($fileId));

$uri = ROOT."files/".$file['hash'];
if(is_file($uri)) {

	if($file['type']=="image") {

		$headers = apache_request_headers();
		header('Cache-Control: must-revalidate');

		if (isset($headers['If-Modified-Since']) && (strtotime($headers['If-Modified-Since']) == filemtime($uri))) {
			header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($uri)).' GMT', true, 304);
		} else {
			header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($uri)).' GMT', true, 200);
			header("Content-Type: image/jpeg");
			header("Content-Length: " .(string)(filesize($uri)) );
			readfile($uri);
		}
	}
} else {
	die("file not found (" . $uri . ")");
}


?>