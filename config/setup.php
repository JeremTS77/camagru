#!/usr/bin/php
<?php
include 'database.php';
try
{
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->exec("DROP DATABASE IF EXISTS ".$DB_NAME);
	$DATABASE = $pdo->exec("CREATE DATABASE IF NOT EXISTS ".$DB_NAME);
	if ($DATABASE)
	{
		echo "Database : ".$DB_NAME." created".PHP_EOL;
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
	$DB_DSNNAME = $DB_DSN.";dbname=".$DB_NAME;
	$pdo = new PDO($DB_DSNNAME , $DB_USER, $DB_PASSWORD);
}
catch(PDOException $e)
{
	die("DB ERROR: ". $e->getMessage());
}

//Creating users table;
$querry = "DROP TABLE IF EXISTS ".$DB_TABLE['users'];
$pdo->exec($querry);
$querry = "CREATE TABLE IF NOT EXISTS ".$DB_TABLE['users']."(id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, login varchar(255) UNIQUE NOT NULL, email varchar(255) NOT NULL UNIQUE, mdp varchar(255) NOT NULL, reset varchar(255));";
$pdo->exec($querry);
echo "Tables: ".$DB_TABLE['users']." created".PHP_EOL;
$pdo->query("INSERT INTO users (login, email, mdp) VALUES('JeremDev', 'jelefebv@student.42.fr', '6a4e012bd9583858a5a6fa15f58bd86a25af266d3a4344f1ec2018b778f29ba83be86eb45e6dc204e11276f4a99eff4e2144fbe15e756c2c88e999649aae7d94')");
$pdo->query("INSERT INTO users (login, email, mdp) VALUES('KassDev', 'kpedro@student.42.fr', 'a8984fe4de44af6af44ee9e1ba250a00a4ccc20d763ff4738df389a9a240c8c42a12c9f6324161d7b53cb3eae9db768414dda6ea07ad2a4a207a6bcba29fb9bf')");


//creating pictures tables;
$querry = "DROP TABLE IF EXIST ".$DB_TABLE['pictures'];
$pdo->exec($querry);
$querry = "CREATE TABLE IF NOT EXISTS ".$DB_TABLE['pictures']."(id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, creation DATETIME NOT NULL  DEFAULT NOW() , deleted BOOLEAN NOT NULL DEFAULT 0, createur VARCHAR(255) NOT NULL, link TEXT NOT NULL);";
$pdo->exec($querry);
echo "Tables: ".$DB_TABLE['pictures']." created".PHP_EOL;


$pdo = null;
echo "you can run \"php -S localhost:8000\"".PHP_EOL;
?>
