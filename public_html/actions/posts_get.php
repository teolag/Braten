<?php
require "../../includes/init.php";

$response = array();


$posts = $db->getArray("SELECT posts.id, title, text, date, writer_id, firstName, lastName FROM posts JOIN users ON posts.writer_id=users.id ORDER BY date DESC LIMIT 5");

$response['posts'] = $posts;



header('Content-Type: application/json');
echo json_encode($response, JSON_NUMERIC_CHECK );
?>