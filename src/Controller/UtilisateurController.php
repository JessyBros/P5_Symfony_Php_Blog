<?php
namespace App\Controller;

use PDO;
use App\Model\UtilisateurManager;
use App\Services\Mail;
use App\Services\VerificationConnexion;

class UtilisateurController
{    
    private $twig;
    private $view;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->utilisateurManager = new UtilisateurManager;
    }

    public function connexion()
    {
        // début se connecter
        if (isset($_POST["submit"])) {
            $mdp  = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
            $email  = isset($_POST['email']) ? $_POST['email'] : NULL;
            $connexion = $this->utilisateurManager-> connexionAdministrateur($email);
            
            if (password_verify($mdp, $connexion->getMotDePasse())) {
                $_SESSION['connecter'] = true;
                $_SESSION['id'] = $connexion->getId();
                $_SESSION['admin'] = $connexion->getPrenom() . " " . $connexion->getNom();
                header('Location:http://localhost/p5_symfony_php_blog/');
                exit;
            } else {
                $messageServeur= '<p id="messageServeur">Email ou mot de passe invalide.</p>';
            }
        } else {
            $messageServeur = "";
        }	
        // fin se connecter
    
    echo $this->twig->render('visiteur/connexion.twig',["messageServeur" => $messageServeur]);
    }

     // DECONNEXION
     public function deconnexion() {
        $_SESSION["connecter"] = false;
        $_SESSION["id"] = null;
        $_SESSION["auteur"] = null;
        header("Location:http://localhost/p5_symfony_php_blog");
    }

    public function inscription()
    {        
        // début inscription
        if (isset($_POST["submit"])) {
            $nom  = isset($_POST['nom']) ? $_POST['nom'] : NULL;
            $prenom  = isset($_POST['prenom']) ? $_POST['prenom'] : NULL;
            $email  = isset($_POST['email']) ? $_POST['email'] : NULL;
            $mdp  = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
            $confirmMdp  = isset($_POST['confirmMdp']) ? $_POST['confirmMdp'] : NULL;

            $verificationEmail = $this->utilisateurManager -> verificationEmail($email);
            $mdp = password_hash($mdp, PASSWORD_DEFAULT);

            if ($verificationEmail) {
                $messageServeur = '<p id="messageServeur">Erreur, l\'email existe déjà !</p>';
            } elseif ($_POST["mdp"] != $_POST["confirmMdp"]) {
                $messageServeur = '<p id="messageServeur">Les mots de passe ne sont pas identique.</p>';    
            } else {
                $inscription = $this->utilisateurManager-> inscription($nom, $prenom, $email, $mdp);
                $messageServeur ='<p id="messageServeurTrue">Votre inscription a été enregistré avec succès !</p>';
            } 
        } else {
        $messageServeur ="";
        }
        
        echo $this->twig->render('visiteur/inscription.twig',["messageServeur" => $messageServeur]);
    }

    public function retrouvezVotreCompte()
    {
        $mail = new Mail;

        // début vérification email existant
        if (isset($_POST["submit"])) {
            $email  = isset($_POST['email']) ? $_POST['email'] : NULL;
            $verificationEmail = $this->utilisateurManager -> verificationEmail($email);
            $id = $verificationEmail->getId();
            $mail ->recupererCompteMail($email,$id);
            $messageServeur = isset($GLOBALS['$messageServeur']) ? $GLOBALS['$messageServeur'] : NULL;
        } else {
            $messageServeur = "";
        }	
        // fin vérification email existant
        
        echo $this->twig->render('visiteur/retrouvezVotreCompte.twig',["messageServeur" => $messageServeur]);
    }

    public function nouveauMotDePasse()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;
        $email  = isset($_GET['email']) ? $_GET['email'] : NULL;

        // début rénitialiser le mot de passe
        if (isset($_POST["submit"])) {
            $mdp  = isset($_POST['mdp']) ? $_POST['mdp'] : NULL;
            $confirmMdp  = isset($_POST['confirmMdp']) ? $_POST['confirmMdp'] : NULL;
            $verificationUtilisateurExist = $this->utilisateurManager->verificationUtilisateurExist($id, $email);
            
            if ($mdp != $confirmMdp) {
                $messageServeur= '<p id="messageServeur">Les mot de passe ne sont pas identiques !</p>';
            } elseif ($verificationUtilisateurExist) {
                $messageServeur= '<p id="messageServeur">Erreur, lors de la vérification de l\'utilisateur<br><a href="retrouvez-votre-compte">-> Faire une nouvelle demande</a></p>"';
            } else {
                $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                $nouveauMotDePasse = $this->utilisateurManager->nouveauMotDePasse($mdp, $id, $email);
                $messageServeur= '<p id="messageServeurTrue">Enregistrement du nouveau mot de passe réussi !</p>';
            }	  
        } else {
            $messageServeur = "";
        }	
        // fin rénitialiser le mot de passe

        echo $this->twig->render('visiteur/nouveauMotDePasse.twig',["messageServeur" => $messageServeur]);
    }


    public function utilisateurs()
    {
        $verificationConnexion = new VerificationConnexion;
        $verificationConnexion->verificationConnexion();

        // début valider utilisateur inscrit
        if (isset($_POST["confirmer"])) {
            $idUtilisateur  = isset($_POST['id']) ? $_POST['id'] : NULL;
            
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






