<?php

if (isset($_POST["modifierSubmit"])) {
    $titre  = isset($_POST['titre']) ? $_POST['titre'] : NULL;
    $chapo  = isset($_POST['chapo']) ? $_POST['chapo'] : NULL;
    $contenu  = isset($_POST['contenu']) ? $_POST['contenu'] : NULL;
	
	$modifierBlog = $modifierBlogManager -> modifierBlog($titre, $chapo, $contenu);

	if ($modifierBlog) {
		$messageServeur ="Le blog a été modifié avec succès !";
	} else {
		$messageServeur = "Erreur lors de la modification du blog !";
	}				
} else {
	$messageServeur ="";
}