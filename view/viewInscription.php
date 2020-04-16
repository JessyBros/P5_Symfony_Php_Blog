<?php ob_start(); ?>

<h1>inscription</h1>

<form action="" method="post">

	<label for="nom">Votre Nom</label>
	<input type="nom" name="nom" id="nom"><br>

	<label for="prenom">Votre Prénom</label>
	<input type="prenom" name="prenom" id="prenom"><br>

	<label for="email">Votre Email</label>
	<input type="email" name="email" placeholder="adresse@hotmail.com" id="email"><br>

	<label for="mdp">Mot de Passe</label>
	<input type="password" name="mdp" placeholder="" id="mdp"><br>

	<label for="confirmMdp">Confirmation du mot de Passe</label>
	<input type="password" name="confirmMdp" placeholder="" id="confirmMdp"><br>

	<input type="submit" name="submit" value="inscription" id="submit"><br>

	<p> <?= $messageServeur ?></p>

</form>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>