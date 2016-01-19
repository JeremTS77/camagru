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
		$DATABASE = $pdo->exec("CREATE DATABASE IF NOT EXISTS camagru");

		if ($DATABASE)
		{
			echo "Database : CAMAGRU created".PHP_EOL;
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
	}
	catch(PDOException $e)
	{
		die("DB ERROR: ". $e->getMessage());
	}
	$TABLE = $pdo->exec("CREATE TABLE IF NOT EXISTS users(id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, login varchar(255) UNIQUE NOT NULL, email varchar(255) NOT NULL UNIQUE, mdp varchar(255) NOT NULL);");
	echo "Tables: USERS created".PHP_EOL;
	$pdo->query("INSERT INTO users (login, email, mdp) VALUES('JeremDev', 'jelefebv@student.42.fr', '36a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94')");
}
?>
