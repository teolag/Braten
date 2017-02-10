<?php

require "../includes/init.php";
$user = Gatekeeper::getUser($db);

$bodyClasses=array();
if(isset($user)) {
	$bodyClasses[] = "authorized";
}
?>

<!doctype html>
<html lang="sv">
	<head>
		<title>Bråtens vänner</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="/img/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
	</head>
	<body class="<?php echo implode(" ", $bodyClasses);?>">



		<header>
			<svg id="btnMenu" viewBox="0 0 50 50" class="icon">
			   <use xlink:href="/img/sprites.svg#icon-list"></use>
			</svg>

			<h1>Bråtens vänner</h1>

			<svg id="btnUser" viewBox="0 0 50 50" class="icon">
				<use xlink:href="/img/sprites.svg#icon-user"></use>
			</svg>
		</header>

		<nav class="main">
			<a href="/"><img src="/img/logo3.png" alt="" class="logo" /></a>

			<ul>
				<li data-action="posts">Inlägg</li>
				<li data-action="about">Om Bråten</li>
				<li data-action="gallery">Galleriet</li>
				<li data-action="documents">Dokument</li>
				<li data-action="planner">Planering</li>
			</ul>
		</nav>

		<nav class="user">
			<div class="username"></div>
			<ul>
				<li data-action="settings">Inställningar</li>
				<li data-action="logout">Logga ut</li>
			</ul>
		</nav>

		<main>
			<section data-id="start">
				<?php include "pages/start.php";?>
			</section>

			<section data-id="about">
				<?php include "pages/about.php";?>
			</section>

			<section data-id="posts">
				<?php include "pages/posts.php";?>
			</section>

			<section data-id="postEdit">
				<?php include "pages/post_edit.php";?>
			</section>

			<section data-id="planner">
				<?php include "pages/planner.php";?>
			</section>

			<section data-id="gallery">
				<?php include "pages/gallery.php";?>
			</section>

			<section data-id="documents">
				<?php include "pages/documents.php";?>
			</section>

			<section data-id="settings">
				<?php include "pages/settings.php";?>
			</section>
		</main>




		<form action="../scripts/login.php" method="post" id="formLogin">
			<img src="/img/logo3.png" alt="" width="200" />
			<div>
				<input type="text" name="userName" id="txtUsername" placeholder="Användarnamn" autofocus />
				<input type="password" name="userPass" id="txtPassword" placeholder="Lösenord" />
				<label id="label_remember" for="remember">
					<input type="checkbox" name="userRemember" id="remember" value="true" />
					Kom ihåg mig
				</label>
				<br />
				<button type="submit">Logga in</button>
			</div>
		</form>

		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script src="//cdn.xio.se/AjaXIO/dev/AjaXIO.js"></script>
		<script src="/js/page.js"></script>
		<script src="/js/braten.js"></script>
		<script src="/pages/about.js"></script>
		<script src="/pages/documents.js"></script>
		<script src="/pages/gallery.js"></script>
		<script src="/pages/planner.js"></script>
		<script src="/pages/posts.js"></script>
		<script src="/pages/post_edit.js"></script>
		<script src="/pages/start.js"></script>
		<script src="/pages/settings.js"></script>
		<script src="/js/main.js"></script>
		<script>
		<?php
		if(isset($user)) {
			echo "setUser(".json_encode($user, JSON_NUMERIC_CHECK).");";
		}
		echo "var easterWeeks = " . json_encode($easterWeeks, JSON_NUMERIC_CHECK) . ";";
		?>
		</script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-15831022-1', 'auto');
		  ga('send', 'pageview');

		</script>
	</body>
</html>