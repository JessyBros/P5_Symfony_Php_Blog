<?php
namespace App\Controller;

use App\Model\UtilisateurManager;
use App\Services\VerificationConnexion;

class UtilisateursController
{    
    private $twig;
    private $utilisateurManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->utilisateurManager = new UtilisateurManager;
    }

    public function utilisateurs()
    {
        $verificationConnexion = new VerificationConnexion;
        $verificationConnexion->verificationConnexion($this->twig);

        // début valider utilisateur inscrit
        if (filter_input(INPUT_POST, 'confirmer')) {
            $idUtilisateur = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            
            $confirmerUtilisateur = $this->utilisateurManager ->confirmerUtilisateur($idUtilisateur);
            if ($confirmerUtilisateur) {
                $messageServeur ='<p id="messageServeurTrue">L\'utilisateur a bien été enregistré en tant qu\'administrateur !</p>';
            } else {
                $messageServeur = '<p id="messageServeur">Erreur lors de la confirmation de l\'utilisateur !</p>';
            }
        } elseif (filter_input(INPUT_POST, 'supprimer')) {
            $idUtilisateur  = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $supprimerUtilisateur = $this->utilisateurManager -> supprimerUtilisateur($idUtilisateur);
            if ($supprimerUtilisateur) {
                $messageServeur = '<p id="messageServeurTrue">L\'utilisateur a bien été supprimé !</p>';
            } else {
                $messageServeur = '<p id="messageServeur">Erreur lors de la suppresion de l\'utilisateur !</p>';
            }
        } else {
            $messageServeur = "";
        }	
        // fin valider utilisateur inscrit

        print_r($this->twig ->render('admin/utilisateurs.twig',["listeUtilisateursInscrits" => $this->utilisateurManager ->listeUtilisateursInscrits(),"messageServeur" => $messageServeur]));
    }

}






