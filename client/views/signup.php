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
			<div class="dat_header">
				<div class="title_project">
					<h1>CAMAGRU</h1>
				</div>
			</div>

		</header>


		<div class= "form">
			<section class="loginform cf">
			<form name="login" action="/server/register.php" method="post" accept-charset="utf-8">
				<div class="email">
					<label for="usermail">Login</label>
					<input name="login" placeholder="Login" required>
				</div>

				<div class="password">
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="password" required>
				</div>

				<input type="submit" value="Login">
			</form>
			</section>
		</div>
		<div>
			<a href="/client/views/siginup.php">Create your account</a>
		</div>


		<script src="client/scripts/take_picture.js"></script>
	</body>

	<footer>
		<div class="dat_footer">

		</div>
	</footer>
<html>
<?php
}
else{
	echo 'All ready login'.PHP_EOL;
}
?>
