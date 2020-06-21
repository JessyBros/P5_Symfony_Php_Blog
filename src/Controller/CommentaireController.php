<?php
namespace App\Controller;

use PDO;
use App\Model\CommentaireManager;
use App\Services\VerificationConnexion;

class CommentaireController
{    
    private $twig;
    private $view;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->commentaireManager = new CommentaireManager;
    }

    public function commentaires()
    {
        $verificationConnexion = new VerificationConnexion;
        $verificationConnexion->verificationConnexion();

        $idCommentaire = isset($_POST['idCommentaire']) ? $_POST['idCommentaire'] : NULL;
        
        // début valider un commentaire
        if (isset($_POST["valider"])) {
            $validerCommentaire = $this->commentaireManager -> validerCommentaire($idCommentaire);
            if ($validerCommentaire) {
            } else {
                $messageServeur = '<p id="messageServeur">Erreur lors de la validation du commentaire !</p>';
            }
        } elseif (isset($_POST["supprimer"])) {
            $supprimerCommentaire = $this->commentaireManager -> supprimerCommentaire($idCommentaire);
            if ($supprimerCommentaire) {
                $messageServeur ='<p id="messageServeurTrue">Le commentaire a bien été supprimé!</p>';
            } else {
                $messageServeur = '<p id="messageServeur">Erreur lors de la suppression du commentaire !</p>';
            }
        } else {
            $messageServeur = "";
        }	
        // fin valider un commentaire

        echo $this->twig ->render('admin/commentaires.twig',["listeDesCommentaires" => $this->commentaireManager ->listeDesCommentaires(),"messageServeur" => $messageServeur]);
    }
}






