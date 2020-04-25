<?php

if (isset($_POST["supprimerSubmit"])) {
	$supprimerBlog = $supprimerBlogManager -> supprimerBlog($idBlog);
	header("Location:modifier-blogs");
	exit;

	if ($supprimerBlog) {
		$messageServeur ="Le blog a bien été supprimé !";
	} else {
		$messageServeur = "Erreur lors de la suppression du blog !";
	}				
} else {
	$messageServeur ="";
}