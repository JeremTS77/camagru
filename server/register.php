<?php
session_start();
if (!isset($_SESSION['login'])){
	try{
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=camagru','root', 'camagru');
		$login	= htmlspecialchars($_POST['login']);
		$mdp	= htmlspecialchars(hash('whirlpool', $_POST['password']));
		$email =  htmlspecialchars($_POST['email']);
		$query = "INSERT INTO users(login, email, mdp)  VALUES('$login', '$email', '$mdp');";
		$pdo->exec($query);
		$pdo = null;
	}
	catch(PDOException $e){
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}

}
else{
	header('Location: /');
	exit;
}
?>