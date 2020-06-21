<?php
namespace App\Model;

use App\Entity\Utilisateur;
use PDO;


class UtilisateurManager extends Manager
{
    // INSCRIPTION UTILISATEUR
    public function inscription($nom, $prenom, $email, $mdp)
    {
         $req = $this->getBdd()->prepare('INSERT INTO utilisateur SET nom = ?, prenom = ?, email = ?, motDePasse = ?, administrateur = false ');
         $req->execute(array(
             $nom,
             $prenom,
             $email,
             $mdp
	     ));
         return $req;
         $req->closeCursor();
	}

    // CONNEXION ADMINISTRATEUR
    public function connexionAdministrateur($email)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM utilisateur WHERE email= ? AND administrateur = true');
        $req->execute(array(
            $email     
         ));
         $data = $req ->fetch(PDO::FETCH_ASSOC);
         $var = new Utilisateur($data);
         return $var;
         $req->closeCursor();
    }


    // AFFICHE LES UTILISATEURS INSCRITS -> NON ADMINISTRATEUR
    public function listeUtilisateursInscrits()
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM utilisateur WHERE administrateur = false');
        $req->execute();
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Utilisateur($data);
        }
        return $var;
        $req->closeCursor();
    }    

    // VALIDER L'INSCRIPTION DE L'UTILISATEUR
    public function confirmerUtilisateur($idUtilisateur)
    {
        $req = $this->getBdd()->prepare('UPDATE utilisateur SET administrateur = true WHERE id= ?');
        $req->execute(array(
            $idUtilisateur
        ));
        return $req;
        $req->closeCursor();
    }

    // REFUSER L'INSCRIPTION D'UN UTILISATEUR
    public function supprimerUtilisateur($idUtilisateur)
    {
        $req = $this->getBdd()->prepare('DELETE FROM utilisateur WHERE id = ?');
        $req->execute(array(
            $idUtilisateur
        ));
        return $req;
        $req->closeCursor();
    }

    // VERIFIE SI LE MAIL EXISTE
    public function verificationEmail(string $email)
    {
       
        $req = $this->getBdd()->prepare('SELECT id, email FROM utilisateur WHERE email = ?');
        $req->execute([
            $email     
        ]);
         $data = $req ->fetch(PDO::FETCH_ASSOC);
         if (!$data) {
            return null;
         }
         $var = new Utilisateur($data);         
         return $var;
         $req->closeCursor();
    }

    // MODIFICATION DU MOT DE PASSE ACTUEL
    public function nouveauMotDePasse($mdp, $id, $email)
    {
        $req = $this->getBdd()->prepare('UPDATE utilisateur SET motDePasse = ? WHERE id= ? AND email = ?');
        $req->execute(array(
            $mdp,
            $id,
            $email
        ));
        return $req;
        $req->closeCursor();
    }

    // VERIFICATION UTILISATEUR EXISTANT
    public function verificationUtilisateurExist($id, $email)
    {
         $req = $this->getBdd()->prepare('SELECT * FROM utilisateur  WHERE id= ? AND email = ? Limit 1');
         $req->execute(array(
            $id, $email     
        ));
        $data = $req->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
         }
        $var = new Utilisateur($data);
        return $var;
        $req->closeCursor();
    }
}
