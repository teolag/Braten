<?php
require "../../includes/init.php";



$user = Gatekeeper::getUser($db);

if(empty($user)) {
	die("access denied, no user");
}



$response = array();
$uploaded = array();
$failed = array();
foreach($_FILES as $f) {

	$hash = md5($f['tmp_name'] . time());
	$file = array(
		"hash"=>$hash,
		"filename"=>$f['name'],
		"size"=>$f['size']
	);

	if(move_uploaded_file($f['tmp_name'], ROOT."files/".$hash)){
		$data = array($f['name'], $user['id'], "image", $hash, $f['size']);
		$file_id = $db->insert("INSERT INTO files(filename, uploader_id, type, hash, size) VALUES(?,?,?,?,?)", $data);
		$file['file_id'] = $file_id;

		$uploaded[] = $file;
	} else {
		$failed[] = $file;
	}
}

$response['status'] = 1000;
$response['uploaded'] = $uploaded;
$response['failed'] = $failed;

header('Content-type: application/json');
echo json_encode($response);

?>