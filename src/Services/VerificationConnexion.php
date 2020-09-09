<?php

namespace App\Services;

use App\Services\SessionObject;

class VerificationConnexion{
    
    public function verificationConnexion($twig) {
        
        $session = new SessionObject();
        if (!filter_var($session->connecter['connecter']) || !filter_var($session->id['id'])) {
            echo $twig->render('error/403.twig');
            exit;
        }
    }
}
