<?php
session_start();

if (isset($_SESSION['user_id'])) {
	header('Location: dashboard.php');
	exit();
}

$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ENT - Connexion</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="login-container">
	  <div class="login-header">
		<h1> ENT Etablissement</h1>
		<p>Espace Numérique de travail</p>
	  </div>

	  <div class="login-body">
		<?php if ($error): ?>
			<div class="error-message">


		<?php if ($error === 'invalid'):  ?>
			id incorrects. Veuillez réessayez.
		<?php elseif ($error === 'empty'): ?>
			Veuillez remplir tous les champs !
		<?php elseif ($error === 'inactive'): ?>
			Votre compte est désactivé, Contactez un administrateur !
		<?php else: ?>
			une erreur est survenue
		<?php endif; ?>
	   </div>
	<?php endif; ?>

	<form action="login_process.php" method="POST">
		<div class="form-group">
			<label for="username">Identifiant</label>
			<input
				type="text"
				id="username"
				name="username"
				placeholder="Votre ID"
				required>
		</div>
		<div class="form-group">
			<label for="password">Mot de passe</label>
			<input
				type="password"
				id="password"
				name="password"
				placeholder="Votre mot de passe"
				required>
		</div>
		<button type="submit" class="btn-login">Se connecter</button>
	</form>
	<div class="login-footer">
		<p>Mot de passe oublié ?<a href="#">Contactez l'administration</a></p>
	</div>

	<div class="info-box">
		<h3>Compte de test dispos : </h3>
		<ul>
			<li><strong>Admin : </strong> admin/ admin123</li>
			<li><strong>Prof : </strong> prof.martin / prof123 </li>
			<li><strong>Eleve : </strong> eleve.durand / eleve123</li>
		</ul>
	</div>
       </div>
   </div>
</body>
</html>










