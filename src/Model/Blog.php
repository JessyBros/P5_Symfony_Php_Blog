<?php

namespace App\Model;

class Blog extends Manager
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

    public function modifierBlog($titre, $chapo, $contenu,$idBlog)
    {
        $connexion = $this-> connexionBdd($titre, $chapo, $contenu, $idBlog);
        $req = $connexion->prepare('UPDATE blog SET titre = ?, chapo = ?, contenu = ?, dateMiseAJour = Now() WHERE id= ?');
        $req->execute(array(
            $titre,
            $chapo,
            $contenu,
            $idBlog
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


    public function numeroDernierBlog()
    {
        $connexion = $this-> connexionBdd();
        $req = $connexion->query('SELECT id FROM blog ORDER BY id DESC Limit 1');
        $req->execute(array());
        $retour = $req->fetch();
        return $retour;

    }

}
