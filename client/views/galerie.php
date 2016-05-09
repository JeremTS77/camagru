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
//Pdo connect
	try{
		$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
		$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);
	}
	catch(PDOException $e){
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
//Pdo connect



//Pagination
	$countqpic = "SELECT id FROM ".$DB_TABLE['pictures'];
	$countpictures = $pdo->prepare($countqpic);
	$countpictures->execute();
	$nbElement = $countpictures->rowCount();
	$nbMaxPage = ceil($nbElement / 3);
if (isset($_GET['p']) && $_GET['p'] > 0  && $_GET['p'] <= $nbMaxPage){
	$cPage = $_GET['p'];
}
else{
	$cPage = 1;
}
//Pagination

//User like for unlike button
if (isset($_SESSION["login"])){
	$q = $pdo->prepare("SELECT refphotoid FROM ".$DB_TABLE['likes']." WHERE LOGIN=:log");
	$q->bindvalue(':log', $_SESSION["login"], PDO::PARAM_STR);
	$qq = $q->execute();
	$liketab = $q->fetchAll();
}
//User like for unlike button

//Get photo per page with limit sql instruction
	$querry = "SELECT link,id,createur  FROM ".$DB_TABLE['pictures']." order by creation DESC LIMIT ". (($cPage-1)*3).",3;";
	$arr = $pdo->query($querry)->fetchAll();
	if (isset($arr)){
		$max = sizeof($arr);
		for($i = 0; $i < $max; $i++){
?>
<div class="photogal" style="">
<span>Auteur : <?php echo $arr[$i]['createur']; ?></span>
<?php
	$likequerry = "SELECT id FROM ".$DB_TABLE['likes']." where refphotoid=".$arr[$i]['id'];
	$q = $pdo->prepare($likequerry);
	$q->execute();
	if ($q->rowCount() > 0){
		?>
		<span style="float:right;"><?php
		echo $q->rowCount(); ?> like<?php if ($q->rowCount() > 1){echo "s";}?></span><?php
	}

if (isset($_SESSION['login'])){
	if (isset($liketab)){
		$maxlike = sizeof($liketab);
		$flag = 0;
		for($j = 0; $j < $maxlike; $j++){
			if ($liketab[$j]['refphotoid'] == $arr[$i]['id']){
				$flag = 1;
			}
		}
		if ($flag == 1){?>
		<form action="/server/unlike.php" method="post">
		<input hidden name="id" value="<?php echo $arr[$i]['id'];?>"/>
		<input hidden name="login" value="<?php echo $_SESSION['login'];?>"/>
		<button type="submit">Unlike</button>
		</form>
<?php }
else {?>
		<form action="/server/like.php" method="post">
		<input hidden name="id" value="<?php echo $arr[$i]['id'];?>"/>
		<input hidden name="login" value="<?php echo $_SESSION['login'];?>"/>
		<button type="submit">Like</button>
		</form>
<?php }
	}
	if (!isset($liketab)){?>
		<form action="/server/like.php" method="post">
		<input hidden name="id" value="<?php echo $arr[$i]['id'];?>"/>
		<input hidden name="login" value="<?php echo $_SESSION['login'];?>"/>
		<button type="submit">Like</button>
		</form>
<?php }} ?>
<br/><img class="GalerieImg" src="<?php echo $arr[$i]['link'];?>"/>
<div class="Commentedzone">
<?php
	$querry = "SELECT comment FROM ".$DB_TABLE['comments']." where photonum=".$arr[$i]['id'].";";
	$array = $pdo->query($querry)->fetchAll();
	$likequerry = "SELECT like FROM ".$DB_TABLE['likes']." where refphotoid=".$arr[$i]['id'];
	$q = $pdo->prepare($likequerry);
	$q->execute();
	$count = $q->rowCount();
	for ($j = 0; $j < sizeof($array); $j++){
		?> <p><?php echo $array[$j]['comment'];?></p><?php
	}
?>
</div>
<?php if (isset($_SESSION['login'])){ ?>
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
	<div style="text-align:center;margin-top:25px;">
<?php
	for ($page = 1; $page <= $nbMaxPage; $page++){
		if ($page == $cPage)
		{
			echo " $page /";
		}
		else
		{
			echo " <a href=\"/client/views/galerie.php?p=$page\">$page</a> /";
		}
	}
?>
</div>
</div>
	<footer>
		<h5>Created By : Jeremy LA @ 42</h5>
	</footer>
	</body>
</html>
