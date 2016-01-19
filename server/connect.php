<?php
try{
	$strConnection = 'mysql:host=127.0.0.1;dbname=camagru';
	$pdo = new PDO($strConnection, 'root', 'camagru');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Ligne 4
	$query = 'SELECT * FROM users;';
	$arr = $pdo->query($query)->fetchAll();
	var_dump($arr);
}
catch(PDOException $e) {
	$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
	die($msg);
}

?>
