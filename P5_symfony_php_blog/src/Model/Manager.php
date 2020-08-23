<?php
namespace App\Model;

use PDO;

class Manager
{
    private static $bdd;
    // INSTANCIE LA CONNEXION À LA BDD
    private static function setBdd()
    {
        self::$bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Permet de générer une exception s'il y a une erreur
        self::$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); //Permet de récupérer les données sous forme d'objet (et non pas de tab. associatif)
    }

    //RÉCUPÉRE LA CONNEXION À LA BDD
    protected function getBdd()
    {
        if (self::$bdd == null) {
            self::setBdd();
        }
        return self::$bdd;
    }
}