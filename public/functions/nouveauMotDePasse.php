<?php

if (isset($_POST["submit"])) {
	$mdp  = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
	$confirmMdp  = isset($_POST['confirmMdp']) ? $_POST['confirmMdp'] : NULL;
	if ($mdp == $confirmMdp)
	{
		$mdp = password_hash($mdp, PASSWORD_DEFAULT);
		$verificationUtilisateurExist = $verificationUtilisateurExistManager->verificationUtilisateurExist($id, $email);
		if ($verificationUtilisateurExist)
		{
			$nouveauMotDePasse = $nouveauMotDePasseManager->nouveauMotDePasse($mdp, $id, $email);
			if ($nouveauMotDePasse)
			{
				$messageServeur= '<p id="messageServeurTrue">Enregistrement du nouveau mot de passe réussi !</p>';
			} else {
				$messageServeur= '<p id="messageServeur">Erreur lors de la modification du mot de passe !</p>';
			}	
		} else {
			$messageServeur= '<p id="messageServeur">Erreur, lors de la vérification de l\'utilisateur<br><a href="retrouvez-votre-compte">-> Faire une nouvelle demande</a></p>"';
		}
		
	} else {
		$messageServeur= '<p id="messageServeur">Les mot de passe ne sont pas identiques !</p>';
	}
} else {
	$messageServeur = "";
}	
/*http://localhost/p5_symfony_php_blog/nouveau-mot-de-passe&id=1&email=j.bros@hotmail.fr 
*/

	