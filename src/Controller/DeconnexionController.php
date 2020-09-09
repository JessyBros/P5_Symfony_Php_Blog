<?php
namespace App\Controller;

use App\Services\SessionObject;


class DeconnexionController
{
    public function deconnexion() {
      
        $session = new SessionObject();
        $session->admin['admin'] = null;
        $session->connecter['connecter'] = false;
        $session->id['id'] = null;
        header("Location:/");
    }
}