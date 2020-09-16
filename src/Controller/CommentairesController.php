<?php
namespace App\Controller;

use App\Model\CommentaireManager;
use App\Services\VerificationConnexion;

class CommentairesController
{    
    private $twig;
    private $commentaireManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->commentaireManager = new CommentaireManager;
    }

    public function commentaires()
    {
        $verificationConnexion = new VerificationConnexion;
        $verificationConnexion->verificationConnexion($this->twig);

        $idCommentaire = filter_input(INPUT_POST, 'idCommentaire');
        
        // début valider un commentaire
        if (filter_input(INPUT_POST, 'valider')) {
            $validerCommentaire = $this->commentaireManager -> validerCommentaire($idCommentaire);
            if ($validerCommentaire) {
                $messageServeur = '<p id="messageServeurTrue">Le commentaire a bien été enregistré !</p>';
            } else {
                $messageServeur = '<p id="messageServeur">Erreur lors de la validation du commentaire !</p>';
            }
        } elseif (filter_input(INPUT_POST, 'supprimer')) {
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

        print_r($this->twig ->render('admin/commentaires.twig',["commentairesEnAttenteDeValidation" => $this->commentaireManager ->CommentairesEnAttenteDeValidation(),"messageServeur" => $messageServeur]));
    }
}






