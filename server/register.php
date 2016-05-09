<?php
include '../config/database.php';
session_start();
if (!isset($_SESSION['login'])){
	try{
		$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
		$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);

	}
	catch(PDOException $e){
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
	if (isset($_GET['confirm'])){
		$stmt = $pdo->prepare("UPDATE ".$DB_TABLE['users']." SET confirmed='1' where confirm=:confirm");
		$stmt->bindValue(':confirm', $_GET['confirm']);
		$stmt->execute();
		$stmt = $pdo->prepare("UPDATE ".$DB_TABLE['users']." SET confirm=NULL where confirm=:confirm");
		$stmt->bindValue(':confirm', $_GET['confirm']);
		$stmt->execute();
		header('Location: /client/views/signin.php');
		exit;
	}
	else{
		$login	= htmlspecialchars($_POST['login']);
		$mdp	= htmlspecialchars(hash('whirlpool', $_POST['password']."camagru"));
		$email =  htmlspecialchars($_POST['email']);
		$headers = 'From: Admin<admin@camagru.42.fr>' . "\r\n" .
			'Reply-To: <admin@camagru.42.fr>' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$stryolo = "";
		for ($i=0; $i <= strlen($salt)/2; $i++){
			$stryolo .= $salt[rand() % strlen($salt)];
		}
		$yolohash = htmlspecialchars(hash('md5', $stryolo.$email));
		$link = "http://localhost:8000/server/register.php?confirm=".$yolohash;
		$msg = "Please click on the below link to active your password : \n" . $link . "\n\nYour activation code is : " . $yolohash;
		mail($email, "Active your account", $msg, $headers);
		$stmt = $pdo->prepare("INSERT INTO ".$DB_TABLE['users']."(login, email, mdp, confirm)  VALUES(:login, :email, :mdp, '$yolohash')");
		$stmt->bindValue(':login', $login);
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':mdp', $mdp);
		$stmt->execute();
	}
	$pdo = NULL;
}
header('Location: /client/views/entercode.php');
exit;
?>
