<?php ob_start(); ?>

<h1>connexion</h1>

<form action="" method="post">

	<label for="email">Votre Email</label>
	<input type="email" name="email" placeholder="adresse@hotmail.com" id="email"><br>

	<label for="mdp">Mot de Passe</label>
	<input type="password" name="mdp" id="mdp"><br>

	<input type="submit" name="submit" value="connexion" id="submit"><br>

	<p> <?= $messageServeur; ?></p>
</form>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>