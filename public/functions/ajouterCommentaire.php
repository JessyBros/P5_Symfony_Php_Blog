<?php

if (isset($_POST["submit"])) {
    $auteur  = isset($_POST['auteur']) ? $_POST['auteur'] : NULL;
    $message  = isset($_POST['message']) ? $_POST['message'] : NULL;
	
	$ajouterCommentaire = $ajouterCommentaireManager -> ajouterCommentaire($auteur, $message, $idBlog);
	
	if ($ajouterCommentaire) {
		$messageServeur = '<p id="messageServeurTrue">Le commentaire a bien été enregistré avec succès en attente de confirmation ! </p>';
	} else {
		$messageServeur = '<p id="messageServeur">Erreur lors de l\'ajout du commentaire ! </p>';
	}		
} else {
	$messageServeur = "";
}	
