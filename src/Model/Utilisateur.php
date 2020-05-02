<?php

namespace App\Model;

class Utilisateur extends Manager
{


    public function inscription($nom, $prenom, $email, $mdp)
    {
         $connexion = $this-> connexionBdd($nom, $prenom, $email, $mdp);
         $req = $connexion->prepare('INSERT INTO utilisateur SET nom = ?, prenom = ?, email = ?, motDePasse = ?, administrateur = false ');
         $req->execute(array(
             $nom,
             $prenom,
             $email,
             $mdp
	     ));
         return $req;
	}

    public function connexionAdministrateur($email)
    {
         $connexion = $this->connexionBdd($email);
         $req = $connexion->prepare('SELECT * FROM utilisateur WHERE email= ? AND administrateur = true');
         $req->execute(array(
            $email     
         ));
         $post = $req->fetch();
         return $post;
    }
    


    public function listeUtilisateursInscrits()
    {
        $connexion = $this-> connexionBdd();
        $req = $connexion->query('SELECT * FROM utilisateur WHERE administrateur = false');
        return $req;
    }

    public function confirmerUtilisateur($idUtilisateur)
    {
        $connexion = $this-> connexionBdd($idUtilisateur);
        $req = $connexion->prepare('UPDATE utilisateur SET administrateur = true WHERE id= ?');
        $req->execute(array(
            $idUtilisateur
        ));
        return $req;
    }

    public function supprimerUtilisateur($idUtilisateur)
    {
        $connexion = $this-> connexionBdd($idUtilisateur);
        $req = $connexion->prepare('DELETE FROM utilisateur WHERE id = ?');
        $req->execute(array(
            $idUtilisateur
        ));
        return $req;
    }




}