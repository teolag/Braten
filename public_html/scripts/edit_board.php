<?php
require "../../includes/init.php";

if(isset($_GET['do']) && $_GET['do']=="delete" && isset($_GET['id'])) {
	$db->execute("DELETE FROM posts WHERE id=".intval($_GET['id'])." LIMIT 1");
}
elseif(empty($_POST['id'])) {

	$db->insertArray("posts", $_POST['post']);

	$notifyUsers = $db->getArray("SELECT id, email, firstName, lastName FROM users WHERE notifyBoard=1 AND email!='' && id!=".$user['id']);
	//var_dump($_POST);
	//var_dump($notifyUsers);
	//exit;

	// Testa skicka bara till mig
	//$notifyUsers = $db->getArray("SELECT id, email, firstName, lastName FROM users WHERE notifyBoard=1 AND email!='' && id=1");


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
}
else {
	$db->updateArray("posts", $_POST['post'],'id', $_POST['id']);
}
header("Location: /planket");



?>
