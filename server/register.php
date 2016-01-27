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
		$querry = "UPDATE ".$DB_TABLE['users']." SET confirm=NULL AND confirmed='1' where confirm='".$_GET['confirm']."';";
		$pdo->exec($querry);
	}
	else{
		$login	= htmlspecialchars($_POST['login']);
		$mdp	= htmlspecialchars(hash('whirlpool', $_POST['password']));
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
		$msg = "Please click on the below link to active your password : \n" . $link;
		mail($email, "Active your account", $msg, $headers);
		$query = "INSERT INTO ".$DB_TABLE['users']."(login, email, mdp, confirm)  VALUES('$login', '$email', '$mdp', '$yolohash');";
		$pdo->exec($query);
	}
	$pdo = NULL;
}
header('Location: /');
exit;
?>
