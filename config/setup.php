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
$querry = "CREATE TABLE IF NOT EXISTS ".$DB_TABLE['users']."(id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, login varchar(255) UNIQUE NOT NULL, email varchar(255) NOT NULL UNIQUE, mdp varchar(255) NOT NULL, reset varchar(255), confirm varchar(255), confirmed BOOLEAN NOT NULL DEFAULT 0);";
$pdo->exec($querry);
echo "Tables: ".$DB_TABLE['users']." created".PHP_EOL;
$pdo->query("INSERT INTO ".$DB_TABLE['users']."(login, email, mdp, confirmed) VALUES('JeremDev', 'jeremy.la@me.com', '94e7d58b3c41c45e989b960e75481f98f3b0d1a1780b866e4c4d16844f35fd968d6ead102c63c4d2e25e28cde7c13428e3c84547b31d70babce39a39ae7d885d', '1')");


//creating pictures tables;
$querry = "DROP TABLE IF EXIST ".$DB_TABLE['pictures'];
$pdo->exec($querry);
$querry = "CREATE TABLE IF NOT EXISTS ".$DB_TABLE['pictures']."(id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, creation DATETIME NOT NULL  DEFAULT NOW() , deleted BOOLEAN NOT NULL DEFAULT 0, createur VARCHAR(255) NOT NULL, link TEXT NOT NULL);";
$pdo->exec($querry);
echo "Tables: ".$DB_TABLE['pictures']." created".PHP_EOL;

//creating comments tables;
$querry = "DROP TABLE IF EXIST ".$DB_TABLE['comments'];
$pdo->exec($querry);
$querry = "CREATE TABLE IF NOT EXISTS ".$DB_TABLE['comments']."(id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, creation DATETIME NOT NULL  DEFAULT NOW() ,  auteur VARCHAR(255) NOT NULL, comment TEXT NOT NULL, photonum INT(11) NOT NULL);";
$pdo->exec($querry);
echo "Tables: ".$DB_TABLE['comments']." created".PHP_EOL;

//creation like tables;
$querry = "DROP TABLE IF EXIST ".$DB_TABLE['likes'];
$pdo->exec($querry);
$querry = "CREATE TABLE IF NOT EXISTS ".$DB_TABLE['likes']."(id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, refphotoid INT(11) NOT NULL ,  LOGIN VARCHAR(255) NOT NULL);";
$pdo->exec($querry);
echo "Tables: ".$DB_TABLE['likes']." created".PHP_EOL;


$pdo = null;
echo "you can run \"php -S localhost:8000 -c php.ini\"".PHP_EOL;
?>
