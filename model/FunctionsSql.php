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

}