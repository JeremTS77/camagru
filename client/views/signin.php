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
			<a href="/client/views/resetpassword.php">Forgotten password ?</a>
			<a href="/client/views/signup.php">Create your account</a>
			</nav>
		</header>

		<h2 class="PageTitle">Sign In</h2>

		<div class= "form">
			<form name="login" action="/server/login.php" method="post" accept-charset="utf-8">
				<div class="input">
					<label for="usermail">Login</label>
					<input name="login" placeholder="Login" required>
				</div>

				<div class="input">
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="password" required>
				</div>

				<button type="submit" class="FormButton">Login</button>
			</form>
		</div>


	<footer>
		<h5>Created By : Jeremy LA @ 42</h5>
	</footer>

		<script src="/client/scripts/take_picture.js"></script>
	</body>
<html>
<?php
}
else{
	echo 'All ready login'.PHP_EOL;
}
?>
