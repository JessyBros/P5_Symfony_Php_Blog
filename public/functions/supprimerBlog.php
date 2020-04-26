<?php

if (isset($_POST["supprimerSubmit"])) {
	$supprimerBlog = $supprimerBlogManager -> supprimerBlog($idBlog);
	if ($supprimerBlog) {
		header("Location:modifier-blogs");
		exit;
	} else {
		$messageServeur = "Erreur lors de la suppression du blog !";
	}				
} else {
	$messageServeur ="";
}