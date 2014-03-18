<?php
$posts = $db->getArray("SELECT posts.id, title, text, date, writer, firstName, lastName FROM posts JOIN users ON posts.writer=users.id ORDER BY date DESC LIMIT 50");


?>

<h2>Planket</h2>

<a href="index.php?page=wall_edit">Skriv ett inlägg</a>

<?php
echo "<ul id='posts'>";
foreach($posts as $post) {
	echo "<li class='post'>";
	echo "<h3>" . $post['title'] . "</h3>";
	echo "<p class='written'>";
		echo $post['firstName'] . " " . $post['lastName'] . " | ";
		echo substr($post['date'],0,10);
		if($post['writer']==$user['id']) {
			echo " | <a href='index.php?page=wall_edit&id=".$post['id']."'>Ändra</a>";
			echo " | <a href='planket/tabort/".$post['id']."'>Ta bort</a>";
		}
		echo "</p>";
	
	echo "<p>" . fixText($post['text']) . "</p>";
	
	echo "</li>";
}
echo "</ul>";
?>

