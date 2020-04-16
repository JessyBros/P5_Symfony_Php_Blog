<?php ob_start(); ?>

<h1>connexion</h1>

<form action="http://localhost/p5_symfony_php_blog/" method="post">

	<label for="email">Votre Email</label>
	<input type="email" name="email" placeholder="adresse@hotmail.com" id="email"><br>

	<label for="mdp">Mot de Passe</label>
	<input type="password" name="mdp" placeholder="" id="mdp"><br>

	<input type="submit" name="submit" value="connexion" id="mdp"><br>

</form>


<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>