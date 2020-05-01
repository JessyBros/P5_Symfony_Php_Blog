<?php

if (isset($_POST["submit"])) {
	$mdp  = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
	
	if ($mdp == $connexion["motDePasse"]) {
		$_SESSION['connecter'] = true;
		$_SESSION['id'] = $connexion['id'];
		$_SESSION['admin'] = $connexion['prenom'] . " " . $connexion['nom'];
		header('Location:http://localhost/p5_symfony_php_blog/');
		exit;
	} else {
		$messageServeur= '<p id="messageServeur">Email ou mot de passe invalide.</p>';
	}
} else {
	$messageServeur = "";
}	
