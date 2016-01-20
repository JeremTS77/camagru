<?php
session_start();
unset($_SESSION['login']);
if (!isset($_POST['login'])){
	print_r("Connectez-vous");
}
else{
	try{
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=camagru','root', '');

		$login	= htmlspecialchars($_POST['login']);
		$mdp	= htmlspecialchars(hash('whirlpool', $_POST['password']));
		$query = "SELECT mdp FROM users where login='$login';";
		$arr = $pdo->query($query)->fetch();
		if ($arr["mdp"] == $mdp){
			echo "All is good".PHP_EOL;
			$_SESSION['login']=$login;
		}
		else{
			echo "Hum something is bad".PHP_EOL;
		}
		$pdo = null;
	}
	catch(PDOException $e){
		$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
		die($msg);
	}
}
?>
