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

    public function connexion($email)
    {
         $connexion = $this->connexionBdd($email);
         $req = $connexion->prepare('SELECT email, motDePasse FROM administrateur WHERE email= ?');
         $req->execute(array(
            $email     
         ));

        return $req;
	}

}