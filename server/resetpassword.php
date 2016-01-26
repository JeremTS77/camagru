<?php
include '../config/database.php';
session_start();
if (!isset($_SESSION['login'])){
	if (isset($_POST['reset'])){
		try
		{
			$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
			$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);
		}
		catch(PDOException $e)
		{
			die("DB ERROR: ". $e->getMessage());
		}
		$mdp	= htmlspecialchars(hash('whirlpool', $_POST['password']));
		$salt = $_POST['reset'];
		$querry = "UPDATE users SET mdp='$mdp' where reset='$salt';";
	}
	else{
		try
		{
			$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
			$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);
		}
		catch(PDOException $e)
		{
			die("DB ERROR: ". $e->getMessage());
		}
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

		$querry = "UPDATE users SET reset='$yolohash' where email='$email';";
		$pdo->exec($querry);

		header('Location: /');
		exit;
	}
}
else{
	header('Location: /');
	exit;
}
?>
