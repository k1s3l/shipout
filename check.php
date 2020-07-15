<?php

	$hostDB = 'localhost';
	$dbName = "register";
	$user = 'root';
	$pass = '';
	$charset = 'utf8';
	$dsn = "mysql:host=$hostDB;dbname=$dbName;charset=$charset";
	$opt = [
					 PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	         PDO::ATTR_EMULATE_PREPARES   => false,
	];
	$pdo = new PDO($dsn, $user, $pass, $opt);
	?>
