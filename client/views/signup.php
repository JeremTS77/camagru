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

		<h2 class="PageTitle">Sign Up</h2>

		<div class= "form">
			<section class="loginform cf">
			<form name="login" action="/server/register.php" method="post" accept-charset="utf-8">
				<div class="email">
					<label for="login">Login</label>
					<input name="login" placeholder="Login" required>
				</div>
				<div class="email">
					<label for="email">Email</label>
					<input name="email" type="email" placeholder="email" required>
				</div>
				<div class="password">
					<label for="password">Password</label>
					<input id="normalpass" type="password" name="password" placeholder="password" onkeyup="verifpass();" required>
				</div>
				<div class="password">
					<label for="confpassword">Confirm</label>
					<input id="repeatpass" type="password" name="confpassword" placeholder="repeat password" onkeyup="verifpass();" required>
				</div>

				<input type="submit" value="Login" id="SignupButton" disabled/>
			</form>
			</section>
		</div>
		<div>
			<a href="/client/views/signin.php">Already register ?</a>
		</div>


	<footer>
	</footer>
	<script src="/client/scripts/verifypass.js"></script>
	</body>
<html>
<?php
}
else{
	echo 'All ready login'.PHP_EOL;
}
?>
