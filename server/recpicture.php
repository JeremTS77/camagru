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
	$login	= htmlspecialchars($_POST['login']);
	$link = $_POST['image'];
	$query = "INSERT INTO ".$DB_TABLE['pictures']."(createur, link)  VALUES('$login', '$link');";
	$pdo->exec($query);
	$pdo = NULL;
}
header('Location: /');
exit;
?>
