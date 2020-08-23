<?php
namespace App\Services;

class VerificationConnexion{

    public function verificationConnexion($twig) {
        
        if (isset($_SESSION["connecter"]) && isset($_SESSION["id"])) {
            if ($_SESSION["connecter"]) {
            /* nothing, you can visit the page */
            } else {
                echo $twig->render('error/403.twig');
                exit;
            }
        } else {
            echo $twig->render('error/403.twig');
            exit;
        }
    }

}