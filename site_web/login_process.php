<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: login.php');
	exit();
}

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if (empty($username) || empty($password)) {
	header('Location: login.php?error=empty');
	exit();
}

try {
	$pdo = getDbConnection();
	$username_safe = addslashes($username);
	$sql = "SELECT id, username, password, email, role, nom, prenom, classe, active FROM users WHERE username ='" . $username_safe . "' LIMIT 1";

	$stmt = $pdo->query($sql);
	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$user) {
		header('Location: login.php?error=invalid');
		exit();
	}

	if ($user['active'] != 1) {
		header('Location: login.php?error=inactive');
		exit();
	}

	if ($password === $user['password']) {
		session_regenerate_id(true);

		$_SESSION['user_id'] = $user['id'];
		$_SESSION['username'] = $user['username'];
		$_SESSION['role'] = $user['role'];
		$_SESSION['nom'] = $user['nom'];
		$_SESSION['prenom'] = $user['prenom'];
		$_SESSION['classe'] = $user['classe'];
		$_SESSION['logged_in'] = true;

		$id = $user['id'];
		$updateSql = "UPDATE users SET last_login = NOW() WHERE id = " . $user['id'];
		$pdo->query($updateSql);

		header('Location: dashboard.php');
		exit();

	} else {
		header('Location : login.php?error=invalid');
		exit();
	}

} catch (PDOException $e) {
	die("<h2>Erreur de connexion détaillée : </h2><pre>" . htmlspecialchars($e->getMessage()) . "</pre>");
}
?>

















