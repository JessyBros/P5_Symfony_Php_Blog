<?php

if (isset($_POST["confirmer"])) {
	$idVisiteur  = isset($_POST['id']) ? $_POST['id'] : NULL;
	$nom  = isset($_POST['nom']) ? $_POST['nom'] : NULL;
	$prenom  = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
	$email  = isset($_POST['email']) ? $_POST['email'] : NULL;
	$motDePasse  = isset($_POST['motDePasse']) ? $_POST['motDePasse'] : NULL;
	
	$confirmerVisiteur = $confirmerVisiteurManager -> confirmerVisiteur($nom, $prenom, $email, $motDePasse);
	$supprimerVisiteur = $supprimerVisiteurManager -> supprimerVisiteur($idVisiteur);
	if ($confirmerVisiteur && $supprimerVisiteur) {
		$messageServeur ="Le visiteur a bien été enregistré en tant qu'administrateur !";
	} else {
		$messageServeur = "Erreur lors de la confirmation du visiteur !";
	}
} elseif (isset($_POST["supprimer"])) {
	$idVisiteur  = isset($_POST['id']) ? $_POST['id'] : NULL;
	$supprimerVisiteur = $supprimerVisiteurManager -> supprimerVisiteur($idVisiteur);
	if ($supprimerVisiteur) {
		$messageServeur ="Le visiteur a bien été supprimé !";
	} else {
		$messageServeur = "Erreur lors de la suppresion du visiteur !";
	}
} else {
	$messageServeur ="";
}