<?php

if (isset($_POST["submit"])) {
    $auteur  = isset($_POST['auteur']) ? $_POST['auteur'] : NULL;
    $message  = isset($_POST['message']) ? $_POST['message'] : NULL;
	
	$ajouterCommentaire = $ajouterCommentaireManager -> ajouterCommentaire($auteur, $message, $idBlog);
	
	if ($ajouterCommentaire) {
		$messageServeur ="Le commentaire a bien été enregistré avec succès en attente de confirmation !";
	} else {
		$messageServeur = "Erreur lors de l'ajout du commentaire !";
	}		
} else {
	$messageServeur ="";
}

