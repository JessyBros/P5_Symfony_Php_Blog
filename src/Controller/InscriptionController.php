<?php
namespace App\Controller;

use App\Model\UtilisateurManager;
use App\Services\VerificationConnexion;

class InscriptionController
{    
    private $twig;
    private $utilisateurManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->utilisateurManager = new UtilisateurManager;
    }

    public function inscription()
    {        
        // début inscription
        if (filter_input(INPUT_POST, 'submit')) {
            $nom = filter_input(INPUT_POST, 'nom');
            $prenom = filter_input(INPUT_POST, 'prenom');
            $email = filter_input(INPUT_POST, 'email');
            $mdp = filter_input(INPUT_POST, 'mdp');
            $confirmMdp = filter_input(INPUT_POST, 'confirmMdp');
     
            $verificationEmailExistant = $this->utilisateurManager -> verificationEmailExistant($email);
            $mdp = password_hash($mdp, PASSWORD_DEFAULT);

            if ($verificationEmailExistant) {
                $messageServeur = '<p id="messageServeur">Erreur, l\'email existe déjà !</p>';
            } elseif ($mdp != $confirmMdp) {
                $messageServeur = '<p id="messageServeur">Les mots de passe ne sont pas identique.</p>';    
            } else {
                $this->utilisateurManager-> inscription($nom, $prenom, $email, $mdp);
                $messageServeur ='<p id="messageServeurTrue">Votre inscription a été enregistré avec succès !</p>';
            } 
        } else {
        $messageServeur ="";
        }
        
        echo $this->twig->render('visiteur/inscription.twig',["messageServeur" => $messageServeur]);
    }
}






