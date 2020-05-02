<?php

if (isset($_POST["confirmer"])) {
	$idUtilisateur  = isset($_POST['id']) ? $_POST['id'] : NULL;
	
	$confirmerUtilisateur = $confirmerUtilisateurManager ->confirmerUtilisateur($idUtilisateur);
	if ($confirmerUtilisateur) {
		$messageServeur ='<p id="messageServeurTrue">L\'utilisateur a bien été enregistré en tant qu\'administrateur !</p>';
	} else {
		$messageServeur = '<p id="messageServeur">Erreur lors de la confirmation de l\'utilisateur !</p>';
	}
} elseif (isset($_POST["supprimer"])) {
	$idUtilisateur  = isset($_POST['id']) ? $_POST['id'] : NULL;
	$supprimerUtilisateur = $supprimerUtilisateurManager -> supprimerUtilisateur($idUtilisateur);
	if ($supprimerUtilisateur) {
		$messageServeur = '<p id="messageServeurTrue">L\'utilisateur a bien été supprimé !</p>';
	} else {
		$messageServeur = '<p id="messageServeur">Erreur lors de la suppresion de l\'utilisateur !</p>';
	}
} else {
	$messageServeur = "";
}	
