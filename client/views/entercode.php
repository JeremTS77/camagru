<?php
session_start();
if (!isset($_SESSION['login'])){
?>
<!DOCTYPE HTML5>
<html>
	<head>
	<meta charset="utf-8" />
		<title>CAMAGRU</title>
		<link rel="stylesheet" type="text/css" href="/client/css/camagru.css" media="all"/>
		<link href='https://fonts.googleapis.com/css?family=Averia+Sans+Libre' rel='stylesheet' type='text/css'>
	</head>

	<body>
		<header>
			<h1>CAMAGRU</h1>
			<nav>
			<a href="/client/views/galerie.php">Galerie</a>
			<a href="/client/views/resetpassword.php">Forgotten password ?</a>
			<a href="/client/views/signin.php">Already register ?</a>
			<a href="/client/views/signup.php">Create your account</a>
			</nav>
		</header>

		<h2 class="PageTitle">Acivation code</h2>

		<div class= "form">
			<form name="login" action="/server/register.php" method="get" accept-charset="utf-8">
				<div class="input">
					<label for="confirm">code</label>
					<input name="confirm" placeholder="code" required autofocus>
				</div>
				<button type="submit" class="FormButton">Active</button>
			</form>
		</div>
	<footer>
		<h5>Created By : Jeremy LA @ 42</h5>
	</footer>
<html>
<?php
}
else{
	echo 'All ready login'.PHP_EOL;
}
?>
