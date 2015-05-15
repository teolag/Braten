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
				<li data-action="news">Nyheter</li>
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

			<section data-id="news">
				<article>
					<h2>Nyheter</h2>
				</article>
			</section>

			<section data-id="planner">
				<article>
					<?php include "pages/planner.php";?>
				</article>
			</section>

			<section data-id="gallery">
				<?php include "pages/gallery.php";?>
			</section>

			<section data-id="documents">
				<article>
					<h2>Dokument</h2>
				</article>
			</section>

			<section data-id="settings">
				<article>
					<h2>Inställningar</h2>
				</article>
			</section>
		</main>




		<form action="../scripts/login.php" method="post" id="formLogin">
			<img src="/img/logo2.png" alt="" width="200" />
			<div>
				<input type="text" name="userName" id="txtUsername" placeholder="Användarnamn" autofocus/>
				<input type="password" name="userPass" id="txtPassword" placeholder="Lösenord" /><br />
				<label id="label_remember" for="remember">
					<input type="checkbox" name="userRemember" id="remember" value="true" />
					Kom ihåg mig
				</label>
				<br />
				<button type="submit">Logga in</button>
			</div>
		</form>

		<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
		<script src="//cdn.xio.se/AjaXIO/dev/AjaXIO.js"></script>
		<script src="/js/page.js"></script>
		<script src="/js/braten.js"></script>
		<script src="/pages/start.js"></script>
		<script src="/pages/planner.js"></script>
		<script src="/pages/gallery.js"></script>
		<script src="/js/main.js"></script>
		<script>
		<?php
		if(isset($user)) {
			echo "setUser(".json_encode($user).");";
		}
		echo "var easterWeeks = " . json_encode($easterWeeks) . ";";
		?>
		</script>
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