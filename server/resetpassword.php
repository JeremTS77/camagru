<?php
include '../config/database.php';
session_start();
if (!isset($_SESSION['login'])){
	try
	{
		$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
		$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);
	}
	catch(PDOException $e)
	{
		die("DB ERROR: ". $e->getMessage());
	}

	if (isset($_POST['reset'])){
		$mdp	= htmlspecialchars(hash('whirlpool', $_POST['password']));
		$salt = $_POST['reset'];
		$stmt = $pdo->prepare("UPDATE " . $DB_TABLE['users']." SET mdp=:mdp where reset=:salt");
		$stmt->bindValue(':mdp', $mdp);
		$stmt->bindValue(':salt', $salt);
		$stmt->execute();
		$stmt = $pdo->prepare("select login from ".$DB_TABLE['users']." where reset=:salt");
		$stmt->bindValue(':salt', $salt);	
		$stmt->execute();
		$array =$stmt->fetch();
		$_SESSION['login']=$array['login'];
		$stmt = $pdo->prepare("UPDATE ".$DB_TABLE['users']." SET reset=NULL where reset=:salt");
		$stmt->bindValue(':salt', $salt);
		$stmt->execute();
	}
	else{
		$email = htmlspecialchars($_POST['email']);
		$headers = 'From: Admin<admin@camagru.42.fr>' . "\r\n" .
			'Reply-To: <admin@camagru.42.fr>' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$stryolo = "";
		for ($i=0; $i <= strlen($salt)/2; $i++){
			$stryolo .= $salt[rand() % strlen($salt)];
		}
		$yolohash = htmlspecialchars(hash('md5', $stryolo.$email));
		$link = "http://localhost:8000/client/views/resetpassword.php?reset=".$yolohash;
		$msg = "Please click on the below link to reset your password : \n" . $link;

		mail($email, "Reset Password", $msg, $headers);

		$stmt = $pdo->prepare("UPDATE ".$DB_TABLE['users']." SET reset='$yolohash' where email=:email");
		$stmt->bindValue(':email', $email);
		$stmt->execute();
	}
	$pdo = NULL;
}
header('Location: /');
exit;
?>
