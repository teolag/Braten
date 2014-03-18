<?php
require "../../includes/init.php";
	
if($_POST['pass1']!=$_POST['pass2']) {
	header("Location: ../mypage.php?mess=1");
	exit;
}
elseif(empty($_POST['pass1'])) {
	header("Location: ../mypage.php?mess=2");
	exit;
}
else {
	$db->execute("UPDATE users SET password='".$_POST['pass1']."' WHERE id=".$user['id']." LIMIT 1");
	header("Location: ../mypage.php?mess=3");
	exit;
}




?>