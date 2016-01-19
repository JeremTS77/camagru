#!/usr/bin/php
<?php
if ($argc != 3)
{
	echo "./install_db.php username password". PHP_EOL;
}
else
{
	$user = $argv[1];
	$password = $argv[2];
	try
	{
		$pdo = new PDO('mysql:host=127.0.0.1', $user, $password);
		$DATABASE = $pdo->exec("CREATE DATABASE camagru");

		if ($DATABASE)
		{
			echo "Database : '$DATABASE' created";
		}
		else
		{
			die(print_r($pdo->errorInfo(), true));
		}
		$pdo = null;
	}
	catch(PDOException $e)
	{
		die("DB ERROR: ". $e->getMessage());
	}
	try
	{
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=camagru', $user, $password);
		$TABLE = $db->exec("CREATE TABLE IF NOT EXISTS users(`id` int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, `login` varchar(255) UNIQUE NOT NULL, `email` varchar(255) NOT NULL UNIQUE, `mdp` varchar(255) NOT NULL");
		if ($TABLE)
		{
		}
		else
		{
			die(print_r($pdo->errorInfo(), true));
		}
	}
	catch(PDOException $e)
	{
		die("DB ERROR: ". $e->getMessage());
	}

?>
