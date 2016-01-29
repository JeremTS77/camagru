<?php
include '../../config/database.php';
session_start();
if (isset($_SESSION['login'])){
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
			<a href="/">Home</a>
			<a href="/server/logout.php">Logout</a>
			</nav>
			<h2>Galerie</h2>
		</header>


<div class="galerie">
<?php 
	try{
		$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
		$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);
	}
	catch(PDOException $e){
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
	$querry = "SELECT link  FROM ".$DB_TABLE['pictures']." ORDER BY creation;";
	$arr = $pdo->query($querry)->fetchAll();
	if (isset($arr)){
		$max = sizeof($arr);
		for($i = 0; $i < $max; $i++){
?>
<img class="GalerieImg" src="<?php echo $arr[$i]['link'];?>"/>
<?php
		}
	}
	$pdo=NULL;
?>



	<footer>
		<h5>Created By : Jeremy LA @ 42</h5>
	</footer>
	</body>
</html>
<?php
}
?>
