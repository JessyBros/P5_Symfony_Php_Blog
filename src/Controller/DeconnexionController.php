<?php
namespace App\Controller;

class DeconnexionController
{
    public function deconnexion() {
        $_SESSION["connecter"] = false;
        $_SESSION["id"] = null;
        $_SESSION["auteur"] = null;
        header("Location:/");
    }
}






