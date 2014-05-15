<?php
if(isset($user['id'])) {
	header("Location: index.php");
	exit;
}
?>





<!doctype html>
<html lang="sv">
	<head>
		<title>Bråtens vänner</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="shortcut icon" href="/img/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
		<style>
			
			
			#loginBox {
				width:470px;
				height:280px;
				top:47%;
				left:50%;
				margin-left:-235px;
				margin-top:-140px;
				background-color:rgba(255,255,255,0.8);
				border-radius:12px;
				position:absolute;
				-moz-box-shadow: 0 2px 3px 0px rgba(0,0,0,0.3);
				-webkit-box-shadow: 0 2px 3px 0px rgba(0,0,0,0.3);
				box-shadow: 0 2px 3px 0px rgba(0,0,0,0.3);
			}
			
			h1 {
				text-indent: -3000px;
				background-image: url("/img/logo150.png");
				display:block;
				float:left;
				width:150px;
				height:150px;
				margin:50px 40px;
			}
			
			form {
				display:block;
				float:left;
				width:200px;
				margin-top:65px;
				text-align:left;
			}
			
			form button {
				float: right;
				border: 0 none;
				padding: 7px 19px;
				clear: both;
				margin-top: 32px;
				border-radius: 8px;
				background-color: #DFDFDF;
				border: 1px solid #A0A0A0;
				color: rgb(66, 66, 66);
			}
			
			form input {
				padding: 6px;
				border-radius: 8px;
			}
			
					
			@media screen and (max-width: 480px) {
			
				#loginBox {
					width:300px;
					height:400px;
					top:45%;
					left:50%;
					margin-left:-150px;
					margin-top:-200px;
					text-align:center;	
				}
				
				h1 {
					float:none;
					background-image: url("/img/logo150.png");
					width:150px;
					height:150px;
					margin:30px auto;					
				}
				
				form {
					float:none;
					width:200px;
					margin:10px auto;
					text-align:center;
				}
				
				form button {
					margin-top:0px;
					float:none;
					
				}
			}
			
			
			
			</style>
	</head>
	<body>
		
		<div id="loginBox">
			<a href="/"><h1>Bråtens vänner</h1></a>
			<form  action="../scripts/login.php" method="post">
				<label for="txt_username">Användare:</label>
				<input type="text" name="userName" id="txt_username" />
				<label for="txt_password">Lösenord:</label>
				<input type="password" name="userPass" id="txt_password" /><br />
				
				<label id="label_remember" for="remember"><input type="checkbox" name="userRemember" id="remember" value="true" /> Kom ihåg mig</label>
				
				<button type="submit">Logga in</button>
			</form>
		</div>

</body>
</html>