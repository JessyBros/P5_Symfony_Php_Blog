<?php

class FunctionsSql extends Manager
{

	 public function lesDerniersBlogs()
    {
        $connexion = $this-> connexionBdd();
        $req = $connexion->query('SELECT * FROM blog  ORDER BY id DESC  LIMIT 4 ');
        return $req;
    }

     public function listeDesBlogs()
    {
        $connexion = $this-> connexionBdd();
        $req = $connexion->query('SELECT * FROM blog  ORDER BY id ASC ');
        return $req;
    }

    public function blog($idBlog)
    {
        $connexion = $this-> connexionBdd($idBlog);
        $req = $connexion->prepare('SELECT * FROM blog WHERE id= ?');
        $req->execute(array($idBlog));
        $post = $req->fetch();
        return $post;
    }


    public function inscription($nom, $prenom, $email, $mdp)
    {
         $connexion = $this-> connexionBdd($nom, $prenom, $email, $mdp);
         $req = $connexion->prepare('INSERT INTO visiteur SET nom = ?, prenom = ?, email = ?, motDePasse = ? ');
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
         $req = $connexion->prepare('SELECT * FROM administrateur WHERE email= ?');
         $req->execute(array(
            $email     
         ));
         $post = $req->fetch();
         return $post;
    }
    

    public function ajouterBlog($titre, $auteur, $chapo, $contenu, $image)
    {
        $connexion = $this-> connexionBdd($titre, $auteur, $chapo, $contenu, $image);
        $req = $connexion->prepare('INSERT INTO blog SET titre = ?, auteur = ?, chapo = ?, contenu = ?, date = Now() , image = ? ');
        $req->execute(array(
            $titre,
            $auteur,
            $chapo,
            $contenu,
            $image
        ));
        return $req;
    }

    public function modifierBlog($titre, $chapo, $contenu)
    {
        $connexion = $this-> connexionBdd($titre, $chapo, $contenu);
        $req = $connexion->prepare('UPDATE blog SET titre = ?, chapo = ?, contenu = ?, dateMiseAJour = Now()');
        $req->execute(array(
            $titre,
            $chapo,
            $contenu
        ));
        return $req;
    }

    public function supprimerBlog($idBlog)
    {
        $connexion = $this-> connexionBdd($idBlog);
        $req = $connexion->prepare('DELETE FROM blog WHERE id = ?');
        $req->execute(array(
            $idBlog
        ));
        return $req;
    }

}
