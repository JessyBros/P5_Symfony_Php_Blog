<?php
namespace App\Services;

class VerificationFichierImage{
    
    public function verificationFichierImage(){
        
        if (!isset($_FILES["image"]) ||  $_FILES['image']['name'] == "") { 
            $GLOBALS['$messageServeur'] = '<p id="messageServeur">Veuillez insérez une image.</p>';
        } else {
            $move = "/../../public/images/blogs/";
            $nom_fichier = $_FILES['image']['name'];
            $type_fichier = $_FILES['image']['type'];
            $taille_fichier = $_FILES['image']['size'];
            if ($nom_fichier == ".htaccess") {
                $GLOBALS['$messageServeur'] = '<p id="messageServeur">Le fichier .htaccess n\'est pas autorisé.</p>';
            } elseif ($type_fichier != "image/jpeg" && $type_fichier != "image/jpg" && $type_fichier != "image/png") {
                $GLOBALS['$messageServeur'] = '<p id="messageServeur">L\'image doit être de type jpeg, jpg ou png.</p>';
            } elseif ($taille_fichier >= 2097153) {
                $GLOBALS['$messageServeur'] = '<p id="messageServeur">L\'image ne doit pas dépassé 2GO</p>';
            } else {
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.$move. $_FILES["image"]['name']);
                $handle = fopen("public/images/blogs/".$nom_fichier, 'r'); //ouverture du fichier
                $content = fread($handle, $taille_fichier); //lecture du fichier
                $f = fclose($handle); //File closing
                $GLOBALS['$imageValider'] = true;
            }
        }
    }

}