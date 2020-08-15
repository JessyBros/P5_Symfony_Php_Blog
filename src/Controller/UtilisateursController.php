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
        if (isset($_POST["confirmer"])) {
            $idUtilisateur = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            
            $confirmerUtilisateur = $this->utilisateurManager ->confirmerUtilisateur($idUtilisateur);
            if ($confirmerUtilisateur) {
                $messageServeur ='<p id="messageServeurTrue">L\'utilisateur a bien été enregistré en tant qu\'administrateur !</p>';
            } else {
                $messageServeur = '<p id="messageServeur">Erreur lors de la confirmation de l\'utilisateur !</p>';
            }
        } elseif (isset($_POST["supprimer"])) {
            $idUtilisateur  = isset($_POST['id']) ? $_POST['id'] : NULL;
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

        echo $this->twig ->render('admin/utilisateurs.twig',["listeUtilisateursInscrits" => $this->utilisateurManager ->listeUtilisateursInscrits(),"messageServeur" => $messageServeur]);
    }

}






