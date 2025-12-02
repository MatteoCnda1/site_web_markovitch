<?php
define('DB_HOST', '192.168.20.10');
define('DB_NAME', 'ent_database');
define('DB_USER', 'ent_user');
define('DB_PASS', 'ent_password');

function getDbConnection() {

	$host = DB_HOST;
	$dbname = DB_NAME;
	$user = DB_USER;
	$pass = DB_PASS;


	$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

	try {

		$pdo = new PDO($dsn, $user, $pass, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => true
		]);
		return $pdo;

	} catch (PDOException $e) {
	    error_log("Erreur de connexion : " . $e->getMessage());
	    throw $e;
	}
}
?>
