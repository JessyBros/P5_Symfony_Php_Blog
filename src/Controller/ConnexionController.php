<?php
namespace App\Controller;

use App\Model\UtilisateurManager;
use App\Services\VerificationConnexion;
use App\Services\SessionObject;

class ConnexionController
{    
    private $twig;
    private $utilisateurManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->utilisateurManager = new UtilisateurManager;
    }

    public function connexion()
    {
        $mdp = filter_input(INPUT_POST, 'mdp');
        $email = filter_input(INPUT_POST, 'email');
        
        $connexion = $this->utilisateurManager-> connexionAdministrateur($email);
        
        // début se connecter
        if (!filter_input(INPUT_POST, 'submit')) {
            $messageServeur = "";
        } elseif ($connexion == null) {
            $messageServeur= '<p id="messageServeur">Email ou mot de passe invalide.</p>';
        } elseif (!password_verify($mdp, $connexion->getMotDePasse())) {
            $messageServeur= '<p id="messageServeur">Email ou mot de passe invalide.</p>';
        } else {
            $session = new SessionObject();
            $session->admin['admin'] = $connexion->getPrenom() . " " . $connexion->getNom();
            $session->connecter['connecter'] = true;
            $session->id['id'] = $connexion->getId();
            header('Location:/');
        }
        
        print_r($this->twig->render('visiteur/connexion.twig',["messageServeur" => $messageServeur]));
    
    }
}
