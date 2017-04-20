<?php
include "../includes/init.php";



$nav = array(
	"start" => array(
		"url"=>"",
		"title"=>"Startsida"
	),
	"wall" => array(
		"url"=>"planket",
		"title"=>"Planket"
	),
	"profile" => array(
		"url"=>"index.php?page=profile",
		"title"=>"Min sida"
	),
	"planner" => array(
		"url"=>"index.php?page=planner",
		"title"=>"Årsplanering"
	),
	"manual" => array(
		"url"=>"braten-rules.pdf",
		"title"=>"Rutiner och regler PDF"
	),
	"logout" => array(
		"url"=>"scripts/logout.php",
		"title"=>"Logga ut"
	)
);



$include_page = 'page_start.php';
$page = "start";
if(isset($_GET['page'])) {
	$page = $_GET['page'];
	if(file_exists("page_{$page}.php")) {
		$include_page = "page_{$page}.php";
	} elseif($page=="logout") {
		header("Location: /scripts/logout.php");
		break;
	}
}








$menuItems = array(
	"Startsida"=>"",
	//"Kalender"=>"calendar.php",
	"Planket"=>"planket",
	"Min sida"=>"mypage.php",
	"Årsplanering"=>"plan.php"
);

?>


<!doctype html>
<html lang="sv">
	<head>
		<title>Bråtens vänner</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="shortcut icon" href="/img/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
	</head>
	<body>
		<div id="site">
			<div id="sidebar" class='box'>
				<a href="/"><h1 id="logo">Bråtens vänner</h1></a>
				
				<ul id="nav_list">
					<?php
					foreach($nav as $name => $n) {
						$classes = array('menu'.$name);
						if($name==$page) $classes[] = 'active';						
						echo "<li><a href='/".$n['url']."' class='".implode(" ", $classes)."'>".$n['title']."</a></li>";
					}
					?>
				</ul>				
				
				<form id="nav_form" action="index.php" method="get">
					<select name="page">
						<option value="">Gå till...</option>
						<?php
						foreach($nav as $name => $n) {
							echo "<option value='{$name}'>{$n['title']}</option>";
						}
						?>
					</select>
					<button type="submit">Go!</button>
				</form>
				
			</div>
			<div id="page" class='box'>
				<?php include $include_page; ?>

			
			</div>
		</div>	
		
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script src="js/script.js"></script>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-15831022-1']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>		
	</body>
</html>
