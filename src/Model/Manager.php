<?php

namespace App\Model;

use PDO;

class Manager
{
    protected function connexionBdd()
    {
        try
        {
	        $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
        }
        return $bdd;

    }

}