<?php
include '../../config/database.php';
session_start();
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
			<?php if (isset($_SESSION['login'])){ ?>
			<a href="/server/logout.php">Logout</a>
			<?php }
			else {?>
			<a href="/client/views/resetpassword.php">Forgotten password ?</a>
			<a href="/client/views/entercode.php">Enter activation code</a>
			<a href="/client/views/signup.php">Create your account</a>
			<?php } ?>
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
	$querry = "SELECT link,id,createur  FROM ".$DB_TABLE['pictures']." order by creation DESC;";
	$arr = $pdo->query($querry)->fetchAll();
	if (isset($arr)){
		$max = sizeof($arr);
		for($i = 0; $i < $max; $i++){
?>
<div class="photogal" style="">
Auteur : <?php echo $arr[$i]['createur']; ?>
<img class="GalerieImg" src="<?php echo $arr[$i]['link'];?>"/>
<div class="Commentedzone">
<?php
	$querry = "SELECT comment FROM ".$DB_TABLE['comments']." where photonum=".$arr[$i]['id'].";";
	$array = $pdo->query($querry)->fetchAll();
	for ($j = 0; $j < sizeof($array); $j++){
		?> <p><?php echo $array[$j]['comment'];?></p><?php
	}
?>
</div>
<?php if (isset($_SESSION['login'])){ ?>
<!--	<form action="/server/like.php" method="post">
		<input hidden name="id" value="<?php echo $arr[$i]['id'];?>"/>
		<input hidden name="login" value="<?php echo $_SESSION['login'];?>"/>
		<button type="submit">Like</button>
		</form>
-->
<form action="/server/comment.php" method="post" class="formcomment">
		<input hidden name="id" value="<?php echo $arr[$i]['id'];?>"/>
		<input hidden name="login" value="<?php echo $_SESSION['login'];?>"/>
		<textarea name="comment" class="commentzone" placeholder="comment here..."></textarea>
		<button type="submit" class="commentbutton">Post comment</button>
	</form>
<?php } ?>
</div>
<?php
		}
	}
	$pdo=NULL;
?>
</div>
	<footer>
		<h5>Created By : Jeremy LA @ 42</h5>
	</footer>
	</body>
</html>
