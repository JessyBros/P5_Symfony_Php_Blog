<?php
namespace App\Services;

class VerificationFichierImage{
    
    public function verificationFichierImage($image){
        
        if (!isset($image) || $image['name'] == "") { 
            $messageServeur = '<p id="messageServeur">Veuillez insérez une image.</p>';
        } elseif ($image['name'] == ".htaccess") {
            $messageServeur = '<p id="messageServeur">Le fichier .htaccess n\'est pas autorisé.</p>';
        } elseif ($image['type'] != "image/jpeg" && $image['type'] != "image/jpg" && $image['type'] != "image/png") {
            $messageServeur = '<p id="messageServeur">L\'image doit être de type jpeg, jpg ou png.</p>';
        } elseif ($image ['size'] >= 2097153) {
            $messageServeur = '<p id="messageServeur">L\'image ne doit pas dépassé 2GO</p>';
        } else {
            $move = "/../../public/images/blogs/";
            move_uploaded_file($image['tmp_name'], __DIR__.$move. $image['name']);
            $messageServeur = 'imageValider';
        }
        return $messageServeur;
    }

}