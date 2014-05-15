<?php
$page=(empty($_GET['id'])? "Skriv" : "Ändra") . " inlägg";


if(empty($_GET['id'])) {
	$post = array();
	$title = "Skapa nytt inlägg";
	$post['writer']=$user['id'];
	$post['id']='';
	$post['title']='';
	$post['text']='';
}
else {
	$post = $db->getRow("SELECT posts.id, title, text, date, writer, firstName, lastName FROM posts JOIN users ON posts.writer=users.id WHERE posts.id=".$_GET['id']." AND users.id=".$user['id']." LIMIT 1");
	if(empty($post)) {
		header("Location: /planket");
		break;
	}
	$title = "Ändra ett inlägg";
}


?>
	
<h2><?php echo $title; ?></h2>

<form action="/scripts/edit_board.php" method="post">
	<input type="hidden" name="id" value="<?php echo $post['id']; ?>" />
	<input type="hidden" name="post[writer]" value="<?php echo $post['writer']; ?>" />
	<label for="txt_title">Rubrik</label><input type="text" name="post[title]" id="txt_title" value="<?php echo $post['title']; ?>" /><br />
	<label for="txt_text">Text</label><textarea cols="60" rows="15" name="post[text]" id="txt_text" class="tinyMCE"><?php echo $post['text']; ?></textarea><br />
	<button type="submit">Spara</button>
</form>

