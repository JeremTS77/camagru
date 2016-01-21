<?php
session_start();
if (!isset($_SESSION['login'])){
	header('Location: /client/views/signin.php');
	exit;
}
else{
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
				<div class="logout_button">
					<a href="/server/logout.php">Logout</a>
				</div>
			</div>

		</header>
		<div class="picture">
			<a href="/client/views/take_picture.php">Take a picture</a>
		</div>


		<script src="/client/scripts/take_picture.js"></script>
	</body>

	<footer>
		<div class="dat_footer">

		</div>
	</footer>
</html>
<?php
}
?>
