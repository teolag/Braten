<?php
require "../../includes/init.php";
	
	
switch($_GET['type']) {


	case "password":	
	if($_POST['pass1']!=$_POST['pass2']) {
		echo '{"error":"Lösenordet måste vara detsamma i båda rutorna"}';
	}
	elseif(empty($_POST['pass1'])) {
		echo '{"error":"Skriv in ett giltigt lösenord i fältet och upprepa samma ord i det andra fältet"}';
	}
	else {
		$db->execute("UPDATE users SET password='".$_POST['pass1']."' WHERE id=".$user['id']." LIMIT 1");
		echo '{"message":"Det nya lösenordet är nu aktivt"}';
	}
	break;
	
	case "notifications":
	if(!isset($_POST['ego']['notifyBoard'])) $_POST['ego']['notifyBoard']=0;
	$db->update("users", $_POST['ego'], "id", $_GET['id']);
	echo '{"message":"Meddelandeinställningar uppdaterade"}';
	break;
	
	
	case "ego":
	$db->update("users", $_POST['ego'], "id", $_GET['id']);
	echo '{"message":"Uppgifterna uppdaterade"}';	
	break;
	
}



?>