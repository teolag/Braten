<?php
require "../../includes/init.php";


$user = Gatekeeper::getUser($db);

if(empty($user)) {
	die("access denied, no user");
}



$response = array();



if(isset($_GET['do']) && $_GET['do']=="delete" && isset($_GET['id'])) {
	$db->execute("DELETE FROM posts WHERE id=".intval($_GET['id'])." LIMIT 1");
} elseif(empty($_POST['id'])) {
	$db->insert("INSERT INTO posts(title, writer_id, text) VALUES(?,?,?)", array($_POST['title'], $user['id'], $_POST['text']));

	$response['message'] = "new post saved";

	$notifyUsers = $db->getArray("SELECT id, email, firstName, lastName FROM users WHERE notifyBoard=1 AND email!='' && id!=".$user['id']);
	//$notifyUsers = $db->getArray("SELECT id, email, firstName, lastName FROM users WHERE notifyBoard=1 AND email!='' && id=1");

	/*
	foreach($notifyUsers as $u) {
		$mail = new PHPMailer(true);

		try {
			$message = "Hej ".$u['firstName']."!<br /><br />Ett nytt inlägg har skrivits på planket.<br /><a href='http://braten.nu/planket'>Klicka här för att undersöka saken</a><br /><br />//Bråten";
			$mail->CharSet='utf-8';
			$mail->AddAddress($u['email'], $u['firstName'] . " " . $u['lastName']);
			$mail->SetFrom('noreply@braten.nu', 'Bråten');
			$mail->Subject = "braten.nu - Nytt inlägg på Planket";
			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
			$mail->MsgHTML($message);
			$mail->Send();
		} catch (phpmailerException $e) {
			die($e->errorMessage());
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	*/
}
else {


}





header('Content-Type: application/json');
echo json_encode($response, JSON_NUMERIC_CHECK );

?>
