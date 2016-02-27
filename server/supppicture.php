<?php
include '../config/database.php';
session_start();
if (isset($_SESSION['login'])){
	try{
		$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
		$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);
	}
	catch(PDOException $e){
		die("DB ERROR: ". $e->getMessage());
	}
	if (isset($_POST['restore'])){
		$stmt = $pdo->prepare("UPDATE " . $DB_TABLE['pictures']." SET deleted=0 where createur=:crea");
		$stmt->bindValue(':crea', $_SESSION['login']);
		$stmt->execute();
	}
	else{
		$stmt = $pdo->prepare("UPDATE " . $DB_TABLE['pictures']." SET deleted=1 where createur=:crea and id=:id");
		$stmt->bindValue(':crea', $_SESSION['login']);
		$stmt->bindValue(':id', $_POST['photoid']);
		$stmt->execute();
	}
	$pdo = NULL;
}
header('Location: /');
exit;

?>
