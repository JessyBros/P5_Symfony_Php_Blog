<?php
namespace App\Services;

class VerificationFichierImage{
    
    public function verificationFichierImage(){

        if (!isset($_FILES["image"]) ||  $_FILES['image']['name'] == "") { 
            $GLOBALS['$messageServeur'] = '<p id="messageServeur">Veuillez insérez une image.</p>';
        } elseif ($_FILES['image']['name'] == ".htaccess") {
            $GLOBALS['$messageServeur'] = '<p id="messageServeur">Le fichier .htaccess n\'est pas autorisé.</p>';
        } elseif ($_FILES['image']['type'] != "image/jpeg" && $_FILES['image']['type'] != "image/jpg" && $_FILES['image']['type'] != "image/png") {
            $GLOBALS['$messageServeur'] = '<p id="messageServeur">L\'image doit être de type jpeg, jpg ou png.</p>';
        } elseif ($_FILES['image']['size'] >= 2097153) {
            $GLOBALS['$messageServeur'] = '<p id="messageServeur">L\'image ne doit pas dépassé 2GO</p>';
        } else {
            $move = "/../../public/images/blogs/";
       
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.$move. $_FILES["image"]['name']);
                $handle = fopen("images/blogs/".$_FILES['image']['name'], 'r'); //ouverture du fichier
                $content = fread($handle, $_FILES['image']['size']); //lecture du fichier
                $f = fclose($handle); //File closing
                $GLOBALS['$imageValider'] = true;
        }
        
    }

}