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

		<h2 class="PageTitle">Reset Password</h2>

		<div class= "form">
			<section class="loginform cf">
			<form name="reset" action="/server/resetpassword.php" method="post" accept-charset="utf-8">
				<div class="email">
					<label for="email">Email</label>
					<input name="email" type="email" placeholder="email" required>
				</div>

				</form>
			</section>
		</div>

		<div>
			<a href="/client/views/signin.php">Already register ?</a>
		</div>
	<footer>
		<div class="dat_footer">
		</div>
	</footer>
	</body>
<html>
<?php
}
else{
	echo 'All ready login'.PHP_EOL;
}
?>
