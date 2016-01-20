<?php
session_start();
unset($_SESSION['login']);
if (!isset($_POST['login'])){
	print_r("Connectez-vous");
}
else{
	try{
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=camagru','root', ''); //add your mysql password here

		$login	= htmlspecialchars($_POST['login']);
		$mdp	= htmlspecialchars(hash('whirlpool', $_POST['password']));
		$query = "SELECT mdp FROM users where login='$login';";
		$arr = $pdo->query($query)->fetch();
<<<<<<< HEAD
		//	var_dump($arr);
=======
>>>>>>> 5ee55f9e428bbf41740d3418131613837b989de1
		if ($arr["mdp"] == $mdp){
			echo "All is good".PHP_EOL;
			$_SESSION['login']=$login;
		}
		else{
<<<<<<< HEAD
			echo $arr["mdp"].PHP_EOL;
			echo $mdp.PHP_EOL;
=======
>>>>>>> 5ee55f9e428bbf41740d3418131613837b989de1
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
