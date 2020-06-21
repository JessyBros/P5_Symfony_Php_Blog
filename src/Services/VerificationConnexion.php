<?php
namespace App\Services;

class VerificationConnexion{
    
    public function verificationConnexion() {
        if (isset($_SESSION["connecter"]) && isset($_SESSION["id"])) {
            if ($_SESSION["connecter"]) {
            /* nothing, you can visit the page */
            } else {
                header("Location:http://localhost/p5_symfony_php_blog");
            }
        } else {
            header("Location:http://localhost/p5_symfony_php_blog");
        }
    }

}