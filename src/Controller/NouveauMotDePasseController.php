<?php
namespace App\Controller;

use App\Model\UtilisateurManager;

class NouveauMotDePasseController
{    
    private $twig;
    private $utilisateurManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->utilisateurManager = new UtilisateurManager;
    }

    public function nouveauMotDePasse($matches)
    {
        $id = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);
        $email = filter_var($matches[2], FILTER_SANITIZE_EMAIL);
        
        $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
        $confirmMdp = filter_input(INPUT_POST, 'confirmMdp', FILTER_SANITIZE_STRING);
        $verificationUtilisateurExist = $this->utilisateurManager->verificationUtilisateurExist($id, $email);

        // début rénitialiser le mot de passe
        if (!isset($_POST["submit"])) {
            $messageServeur = "";
        } elseif ($mdp != $confirmMdp) {
            $messageServeur= '<p id="messageServeur">Les mot de passe ne sont pas identiques !</p>';
        } elseif ($verificationUtilisateurExist == null) {
            $messageServeur= '<p id="messageServeur">Erreur, lors de la vérification de l\'utilisateur<br><a href="retrouvez-votre-compte">-> Faire une nouvelle demande</a></p>"';
        } else {
            $mdp = password_hash($mdp, PASSWORD_DEFAULT);
            $this->utilisateurManager->modificationMotDePasse($mdp, $id, $email);
            $messageServeur= '<p id="messageServeurTrue">Enregistrement du nouveau mot de passe réussi !</p>';
        }	  

        echo $this->twig->render('visiteur/nouveauMotDePasse.twig',["messageServeur" => $messageServeur]);
    }
}






