<?php
session_start();
unset($_SESSION['login']);
if (!isset($_POST['login'])){
	header('Location: /client/views/signin.php');
	exit;
}
else{
	try{
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=camagru','root', 'camagru'); //add your mysql password here
		$login	= htmlspecialchars($_POST['login']);
		$mdp	= htmlspecialchars(hash('whirlpool', $_POST['password']));
		$query = "SELECT mdp FROM users where login='$login';";
		$arr = $pdo->query($query)->fetch();
		if ($arr["mdp"] == $mdp){
			usleep(5);
			$_SESSION['login']=$login;
			header('Location: /');
			exit;
		}
		else{
			header('Location: /client/views/signin.php');
			exit;
		}
		$pdo = null;
	}
	catch(PDOException $e){
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
}
?>
