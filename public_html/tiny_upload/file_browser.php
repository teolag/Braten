<?php
$type = $_GET['type'];
if($type==="image") {
	$info = "Välj en bild att ladda upp";
} else {
	$info = "Välj en fil att ladda upp";
}




?>


<p><?php echo $info; ?></p>


<input type="file" name="filename" id="fileBrowser" />


<script src="/tiny_upload/file_browser.js"></script>