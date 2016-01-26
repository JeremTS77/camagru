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

<body onload="init();">
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

		<h2 class="PageTitle">Take Picture</h2>


		<video id="video" class="VideoRendu" autoplay></video>
		<button id="startbutton">Take Picture</button>
		<canvas id="canvas"></canvas>
		<form>
			<input  name="image" id="toto"/>
			<input 	name="login" value="<?php echo $_SESSION['login']?>"/>
		</form>

		<script src="/client/scripts/take_picture.js"></script>
	<footer>
		<div class="dat_footer">

		</div>
	</footer>
	</body>
</html>
<?php
}
?>
