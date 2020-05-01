<?php

if (isset($_POST["valider"])) {
	$validerCommentaire = $validerCommentaireManager -> validerCommentaire($idCommentaire);
	if ($validerCommentaire) {
		$messageServeur ='<p id="messageServeurTrue">Le commentaire a été validé avec succès !</p>';
	} else {
		$messageServeur = '<p id="messageServeur">Erreur lors de la validation du commentaire !</p>';
	}
} elseif (isset($_POST["supprimer"])) {
	$supprimerCommentaire = $supprimerCommentaireManager -> supprimerCommentaire($idCommentaire);
	if ($supprimerCommentaire) {
		$messageServeur ='<p id="messageServeurTrue">Le commentaire a bien été supprimé!</p>';
	} else {
		$messageServeur = '<p id="messageServeur">Erreur lors de la suppression du commentaire !</p>';
	}
} else {
	$messageServeur = "";
}	
