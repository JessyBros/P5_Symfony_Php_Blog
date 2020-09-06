<?php
namespace App\Services;

class Mail{

    public function mailForm(){
        $nom  = filter_input(INPUT_POST, 'nom');
        $email  = filter_input(INPUT_POST, 'email');
        $message  = filter_input(INPUT_POST, 'message');
        
        error_reporting(E_ALL); ini_set("display_errors", 1); //Display errors
        $message = "
                Nom : " . $nom . "
                Email : " . $email . "
                message : " . $message;
        
            //vérifie si l'hote autorise les \r
            if (preg_match("#@(hotmail|outlook|gmail).[a-z]{2,4}$#", "j.bros@hotmail.fr") ){
                $passage_ligne = "\n";
            } else {
                $passage_ligne = "\r\n";
            }
            $email_to = "j.bros@hotmail.fr"; // Reçois
            $email_subject = "Contact - Blog Jessy"; // Sujet
            $boundary = md5(rand()); // Clé boundary aléatoire
            function clean_string($string) {
                $bad = array("content-type","bcc:","to:","cc:","href");
                return str_replace($bad,"",$string);
            } 
            
        $headers = "From: Blog de Jessy <jesscmnk@world-400.fr.planethoster.net>" . $passage_ligne; //mail du serveur (pour le connaître enlever cette ligne et récupérer sur le mail)
        $headers.= "Reply-to: Blog de Jessy <jesscmnk@world-400.fr.planethoster.net>" . $passage_ligne; //Celui qui envoi
        $headers.= "MIME-Version: 1.0" . $passage_ligne; //MIME Version
        $headers.= "X-Priority: 3".$passage_ligne;
        $headers.= 'Content-Type: multipart/alternative; boundary='.$boundary .' '. $passage_ligne; //Content (2 versions ex:text/plain et text/html)
        $email_message = '--' . $boundary . $passage_ligne; //Ouverture boundary
        $email_message .= "Content-Type: text/plain; charset=\"utf-8\"" . $passage_ligne; //Content type
        $email_message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne; //Encoding
        $email_message .= $passage_ligne .clean_string($message). $passage_ligne; //Content
        $email_message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne; //Closing boundary

        if (mail($email_to,$email_subject, $email_message, $headers)) {
            $messageServeur = '<p id="messageServeurTrue">Le mail a bien été envoyé </p>';
        } else {
            $messageServeur = '<p id="messageServeur">Erreur, lors de l\'envoie du maixxl</p>';
        } 
        return $messageServeur;
    }


    // début mail récupération du compte
    public function recupererCompteMail($email, $id)
    {
            error_reporting(E_ALL); ini_set("display_errors", 1); //Display errors
            
            $message = 'Pour rénitiliser votre mot de passe, cliquez sur le lien en suivant
            https://jessy-bros.com/nouveau-mot-de-passe-' . $id . '-' . $email;
          
                //vérifie si l'hote autorise les \r
                if (preg_match("#@(hotmail|outlook|gmail).[a-z]{2,4}$#", $email)) {
                    $passage_ligne = "\n";
                } else {
                    $passage_ligne = "\r\n";
                }

                $email_to = $email; // Reçois
                $email_subject = "Récupération compte - Blog Jessy"; // Sujet
                $boundary = md5(rand()); // Clé boundary aléatoire
                function clean_string($string) {
                    $bad = array("content-type","bcc:","to:","cc:","href");
                    return str_replace($bad,"",$string);
                } 
                
                $headers = "From: Blog de Jessy <jesscmnk@world-400.fr.planethoster.net>" . $passage_ligne; //mail du serveur (pour le connaître enlever cette ligne et récupérer sur le mail)
                $headers.= "Reply-to: Blog de Jessy <jesscmnk@world-400.fr.planethoster.net>" . $passage_ligne; //Celui qui envoi
                $headers.= "MIME-Version: 1.0" . $passage_ligne; //MIME Version
                $headers.= "X-Priority: 3".$passage_ligne;
                $headers.= 'Content-Type: multipart/alternative; boundary='.$boundary .' '. $passage_ligne; //Content (2 versions ex:text/plain et text/html)
                $email_message = '--' . $boundary . $passage_ligne; //Ouverture boundary
                $email_message .= "Content-Type: text/plain; charset=\"utf-8\"" . $passage_ligne; //Content type
                $email_message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne; //Encoding
                $email_message .= $passage_ligne .clean_string($message). $passage_ligne; //Content

            $email_message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne; //Closing boundary

            if (mail($email_to,$email_subject, $email_message, $headers)) {
               $messageServeur = '<p id="messageServeurTrue">Le mail a bien été envoyé </p>';
            } else {
                $messageServeur = '<p id="messageServeur">Erreur, lors de l\'envoie du mail</p>';
            }

            return $messageServeur;
    }
    // fin mail récupération du compte
}
