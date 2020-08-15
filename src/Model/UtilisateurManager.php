<?php
namespace App\Model;

use App\Entity\Utilisateur;
use PDO;


class UtilisateurManager extends Manager
{
    public function inscription($nom, $prenom, $email, $mdp)
    {
         $req = $this->getBdd()->prepare('INSERT INTO utilisateur SET nom = ?, prenom = ?, email = ?, motDePasse = ?, droit_administrateur = false ');
         $req->execute(array(
             $nom,
             $prenom,
             $email,
             $mdp
	     ));
         return $req;
         $req->closeCursor();
	}

    public function connexionAdministrateur($email)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM utilisateur WHERE email= ? AND droit_administrateur = true');
        $req->execute(array(
            $email     
         ));
         $data = $req ->fetch(PDO::FETCH_ASSOC);
         if (!$data) {
            return null;
         }
         $var = new Utilisateur($data);
         return $var;
         $req->closeCursor();
    }

    public function listeUtilisateursInscrits()
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM utilisateur WHERE droit_administrateur = false');
        $req->execute();
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Utilisateur($data);
        }
        return $var;
        $req->closeCursor();
    }    

    public function confirmerUtilisateur($idUtilisateur)
    {
        $req = $this->getBdd()->prepare('UPDATE utilisateur SET droit_administrateur = true WHERE id= ?');
        $req->execute(array(
            $idUtilisateur
        ));
        return $req;
        $req->closeCursor();
    }

    public function supprimerUtilisateur($idUtilisateur)
    {
        $req = $this->getBdd()->prepare('DELETE FROM utilisateur WHERE id = ?');
        $req->execute(array(
            $idUtilisateur
        ));
        return $req;
        $req->closeCursor();
    }

    public function verificationEmailExistant(string $email)
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

    public function modificationMotDePasse($mdp, $id, $email)
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
