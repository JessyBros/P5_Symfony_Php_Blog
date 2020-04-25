<?php

if (isset($_POST["submit"])) {
		$nom  = isset($_POST['nom']) ? $_POST['nom'] : NULL;
	    $prenom  = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
	    $email  = isset($_POST['email']) ? $_POST['email'] : NULL;
	    $mdp  = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
	    $confirmMdp  = isset($_POST['confirmMdp']) ? $_POST['confirmMdp'] : NULL;
		  	
	if ($_POST["mdp"] == $_POST["confirmMdp"]) {
		$inscription = $inscriptionManager-> inscription($nom, $prenom, $email, $mdp);

		if ($inscription) {
			$messageServeur ="Votre inscription a �t� enregistr� avec succ�s !";
		} else {
			$messageServeur = "Erreur, l'inscription n'a pas pu �tre valid� !";
		}
	} else {
		$messageServeur = "Les mots de passe ne sont pas identique.";
	}
} else {
	$messageServeur ="";
}