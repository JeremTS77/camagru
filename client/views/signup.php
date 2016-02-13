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
		<a href="/client/views/entercode.php">Enter activation code</a>
		</nav>
	</header>
	<h2 class="PageTitle">Sign Up</h2>

	<div class= "form">
		<form name="login" action="/server/register.php" method="post" accept-charset="utf-8">
			<div class="input">
				<label for="login">Login</label>
				<input name="login" placeholder="Login" required autofocus>
			</div>
			<div class="input">
				<label for="email">Email</label>
				<input name="email" type="email" placeholder="email" required>
			</div>
			<div class="input">
				<label for="password">Password</label>
				<input id="normalpass" type="password" name="password" placeholder="password" onkeyup="verifpass();" required>
			</div>
			<div class="input">
				<label for="confpassword">Confirm Password</label>
				<input id="repeatpass" type="password" name="confpassword" placeholder="repeat password" onkeyup="verifpass();" required>
			</div>

			<button type="submit" value="Login" id="SignupButton" disabled  class="FormButton">Login</button>
		</form>
	</div>

<footer>
	<h5>Created By : Jeremy LA @ 42</h5>
</footer>
<script src="/client/scripts/verifypass.js"></script>
</body>
<html>
<?php
}
else{
header('Location: /');
exit;
}
?>
