<?php
include '../config/database.php';
session_start();
if (isset($_SESSION['login'])){
	try{
		$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
		$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);

	}
	catch(PDOException $e){
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
	$comment	= htmlspecialchars($_POST['comment']);
	$login		= htmlspecialchars($_POST['login']);
	$id			= htmlspecialchars($_POST['id']);
	$query = "INSERT INTO ".$DB_TABLE['comments']."(auteur, photonum, comment)  VALUES('$login', '$id', '$comment');";
	$pdo->exec($query);
	$query = "SELECT createur FROM ".$DB_TABLE['pictures']." WHERE id=".$id.";";
	$arr = $pdo->query($query)->fetch();
	$query = "SELECT email FROM ".$DB_TABLE['users']." WHERE login='".$arr['createur']."';";
	$array = $pdo->query($query)->fetch();
	$email = $array['email'];
	$pdo = NULL;
	$headers = 'From: Admin<admin@camagru.42.fr>' . "\r\n" .
		'Reply-To: <admin@camagru.42.fr>' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
	$msg = "'$login' commented on one of your photos.\n\n'$login' : '$comment'";
	mail($email, "New Comment", $msg, $headers);
}
header('Location: /client/views/galerie.php');
exit;
?>
