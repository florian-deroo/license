<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="wrapper">
		  <div class="title">License</div>
		  <form action="/api/manager.php" method="get">
			<input type="hidden" name="type" value="add">
			<div class="field">
			  <input type="text" name="user" required>
			  <label>Utilisateur</label>
			</div>
			<div class="field">
			  <input type="text" name="plugin" required>
			  <label>Plugin</label>
			</div>
			<div class="field">
			  <input type="text" name="ip_limit" required>
			  <label>Limite d'ip</label>
			</div>
			<div class="field">
			  <input type="text" name="password" required>
			  <label>MDP</label>
			</div>
			<div class="content">
				<div class="field">
					<input type="submit" value="Ajouter">
				</div>
			</div>
			</form>
		</div>
		<?php
		$key = $_GET['status'];
		if ($key!=null) {
		if ($key != 'failed') { ?>
		<div class ="hidden-slow">
			<div class="success-container">
				<div class="row">
					<div class="modalbox success">
						<div class="icon">✔</div>
						<div class="changefont">
						<h1>Succès !</h1>
						<p><br>
						License attribuée avec succès.
						<br>
							<br>Clé: <?php echo $key;?>
						</div>
						</p>
					</div>
				</div>
			</div>
		<?php } else {?>
		<div class ="hidden-fast">
			<div class="fail-container">
				<div class="row">
					<div class="modalbox fail icon">
						<div class="icon">✖</div>
						<div class="changefont">
						<h1>Erreur</h1>
						<p><br>
						Mot de passe incorrect.
						<br>
						</div>
						</p>
					</div>
				</div>
			</div>
		</div>
		</div>
		<?php }}?>
	</body>
</html>
