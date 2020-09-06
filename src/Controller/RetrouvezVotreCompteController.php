<?php
namespace App\Controller;

use App\Model\UtilisateurManager;
use App\Services\Mail;

class RetrouvezVotreCompteController
{    
    private $twig;
    private $utilisateurManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->utilisateurManager = new UtilisateurManager;
    }

    public function retrouvezVotreCompte()
    {
        $mail = new Mail;

        // début vérification email existant
        if (filter_input(INPUT_POST, 'submit')) {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $verificationEmailExistant = $this->utilisateurManager -> verificationEmailExistant($email);
            $id = $verificationEmailExistant->getId();
            $messageServeur = $mail ->recupererCompteMail($email,$id);
        } else {
            $messageServeur = "";
        }	
        // fin vérification email existant
        
        echo $this->twig->render('visiteur/retrouvezVotreCompte.twig',["messageServeur" => $messageServeur]);
    }
}






