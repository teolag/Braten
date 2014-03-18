<?php
$page = "Kalender";
require "../includes/init.php";

if(empty($_GET['id'])) {
	$booking = array();
	$title = "Skapa nytt inlägg";
	$booking['writer']=$user['id'];
}
else {
	$booking = $db->getRow("SELECT * FROM booking JOIN users ON posts.writer=users.id WHERE posts.id=".$_GET['id']." AND users.id=".$user['id']." LIMIT 1");
	$title = "Ändra ett inlägg";
}

require "../includes/header.php";

?>
	
<h2>Kalender</h2>

<label for="date_from">Ankomst: </label><input id="date_from" type="text">

<label for="date_to">Avresa: </label><input id="date_to" type="text">

<div id="nights"></div>

<?php
require "../includes/footer.php";
?>
	