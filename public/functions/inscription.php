<?php

if (isset($_POST["submit"])) {
		$nom  = isset($_POST['nom']) ? $_POST['nom'] : NULL;
	    $prenom  = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
	    $email  = isset($_POST['email']) ? $_POST['email'] : NULL;
	    $mdp  = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
	    $confirmMdp  = isset($_POST['confirmMdp']) ? $_POST['confirmMdp'] : NULL;
		  	
	if ($_POST["mdp"] == $_POST["confirmMdp"]) {
		$mdp = password_hash($mdp, PASSWORD_DEFAULT);
		$inscription = $inscriptionManager-> inscription($nom, $prenom, $email, $mdp);

		if ($inscription) {
			$messageServeur ='<p id="messageServeurTrue">Votre inscription a été enregistré avec succès !</p>';
		} else {
			$messageServeur = '<p id="messageServeur">Erreur, l\'inscription n\'a pas pu être validé !</p>';
		}
	} else {
		$messageServeur = '<p id="messageServeur">Les mots de passe ne sont pas identique.</p>';
	}
} else {
	$messageServeur ="";
}