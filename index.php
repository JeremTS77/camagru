<?php
include 'config/database.php';
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
			<h1>CAMAGRU</h1>
			<nav>
			<a href="/client/views/galerie.php">Galerie</a>
			<a href="/server/logout.php">Logout</a>
			</nav>
			<h2>Take Picture</h2>
		</header>


		<video id="video" class="VideoRendu" autoplay></video>
		<button id="startbutton">Take Picture</button>
		<canvas hidden id="canvas"></canvas>
		<form action="/server/recpicture.php" name="uploadphoto" method="post" hidden>
			<input name="image" id="toto" hidden/>
			<input name="login" value="<?php echo $_SESSION['login']?>" hidden/>
		</form>
<div class="myphoto">
<?php
	try{
		$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
		$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);
	}
	catch(PDOException $e){
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
	$querry = "SELECT link FROM ".$DB_TABLE['pictures']." WHERE createur='".$_SESSION['login']."'";
	$arr = $pdo->query($querry)->fetchAll();
	if (isset($arr)){
		$max = sizeof($arr);
		for($i = 0; $i < $max; $i++){
?>
<img src="<?php echo $arr[$i]['link'];?>"/>
<?php
		}
	}
	$pdo=NULL;
?>
</div>
	<script src="/client/scripts/take_picture.js"></script>
	<footer>
		<h5>Created By : Jeremy LA @ 42</h5>
	</footer>
	</body>
</html>
<?php
}
?>
