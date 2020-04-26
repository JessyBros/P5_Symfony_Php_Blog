<?php

if (isset($_POST["valider"])) {
	$validerCommentaire = $validerCommentaireManager -> validerCommentaire($idCommentaire);
	if ($validerCommentaire) {
		$messageServeur ="Le commentaire a été validé avec succès !";
	} else {
		$messageServeur = "Erreur lors de la validation du commentaire !";
	}
} elseif (isset($_POST["supprimer"])) {
	$supprimerCommentaire = $supprimerCommentaireManager -> supprimerCommentaire($idCommentaire);
	if ($supprimerCommentaire) {
		$messageServeur ="Le commentaire a bien été supprimé!";
	} else {
		$messageServeur = "Erreur lors de la suppression du commentaire !";
	}
} else {
	$messageServeur ="";
}