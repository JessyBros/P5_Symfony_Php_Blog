<?php

if (isset($_POST["supprimer"])) {
	$image  = isset($_POST['image']) ? $_POST['image'] : NULL;
	$supprimerBlog = $supprimerBlogManager -> supprimerBlog($idBlog);
	if ($supprimerBlog) {
		$supprimerCommentairesDuBlog = $supprimerCommentairesDuBlogManager -> supprimerCommentairesDuBlog($idBlog);
		if ($supprimerCommentairesDuBlog){
			$pathImage = 'public/images/blogs/' . $image;
			if (file_exists($pathImage)) {
				unlink($pathImage);
				header("Location:modifier-blogs");
				exit;
			} else{
				$messageServeur = '<p id="messageServeur">Erreur, l\'image du blog n\'a pas été supprimé. Blog et commentaires supprimés !</p>';
			}
			
		} else {
			$messageServeur = '<p id="messageServeur">Erreur, la suppression des commentaires a échoué malgré la suppresion du blog !</p>';
		}
	} else {
		$messageServeur = '<p id="messageServeur">Erreur lors de la suppression du blog !</p>';
	}				
}

