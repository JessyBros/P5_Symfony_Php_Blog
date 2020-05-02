<?php

if (isset($_POST["modifier"])) {
    $titre  = isset($_POST['titre']) ? $_POST['titre'] : NULL;
    $chapo  = isset($_POST['chapo']) ? $_POST['chapo'] : NULL;
    $contenu  = isset($_POST['contenu']) ? $_POST['contenu'] : NULL;
	
	$modifierBlog = $modifierBlogManager -> modifierBlog($titre, $chapo, $contenu, $idBlog);

	if ($modifierBlog) {
		$messageServeur ='<p id="messageServeurTrue">Le blog a été modifié avec succès ! </p>';
	} else {
		$messageServeur = '<p id="messageServeur">Erreur lors de la modification du blog !</p>';
	}				
} else {
	$messageServeur ="";
}