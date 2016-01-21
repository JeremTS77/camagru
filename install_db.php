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
		$pdo->exec("DROP DATABASE IF EXISTS camagru");
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
	$pdo->exec("DROP TABLE IF EXISTS users");
	$TABLE = $pdo->exec("CREATE TABLE IF NOT EXISTS users(id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, login varchar(255) UNIQUE NOT NULL, email varchar(255) NOT NULL UNIQUE, mdp varchar(255) NOT NULL);");
	echo "Tables: USERS created".PHP_EOL;
	$pdo->query("INSERT INTO users (login, email, mdp) VALUES('JeremDev', 'jelefebv@student.42.fr', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94')");
	$pdo->query("INSERT INTO users (login, email, mdp) VALUES('KassDev', 'kpedro@student.42.fr', 'a8984fe4de44af6af44ee9e1ba250a00a4ccc20d763ff4738df389a9a240c8c42a12c9f6324161d7b53cb3eae9db768414dda6ea07ad2a4a207a6bcba29fb9bf')");
	$pdo = null;
	echo "you can run \"php -S localhost:8000\"".PHP_EOL;
}
?>
