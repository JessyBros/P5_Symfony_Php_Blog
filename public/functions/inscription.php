<?php

if ( isset($_POST["submit"]) )
{
		$nom  = isset($_POST['nom']) ? $_POST['nom'] : NULL;
	    $prenom  = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
	    $email  = isset($_POST['email']) ? $_POST['email'] : NULL;
	    $mdp  = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
	    $confirmMdp  = isset($_POST['confirmMdp']) ? $_POST['confirmMdp'] : NULL;
		  
		
	if ( $_POST["mdp"] == $_POST["confirmMdp"] )
	{

		$inscription = $inscriptionManager-> inscription($nom, $prenom, $email, $mdp);

		if( $inscription )
		{
			$messageServeur ="Votre inscription a été enregistré avec succès !";
		}
		else
		{
			$messageServeur = "Erreur, l'inscription n'a pas pu être validé !";
		}
	}
	else{
		$messageServeur = "Les mots de passe ne sont pas identique.";
	}

}
else{
	$messageServeur ="";
}