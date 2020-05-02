<?php

namespace App\Model;

class Commentaire extends Manager
{


    public function commentairesBlog($idBlog)
    {
        $connexion = $this-> connexionBdd($idBlog);
        $req = $connexion->prepare('SELECT * FROM commentaire WHERE blog_id = ? AND valider = true ORDER BY date DESC');
        $req->execute(array($idBlog));
        return $req;
    }

    public function ajouterCommentaire($auteur, $message, $idBlog)
    {
        $connexion = $this-> connexionBdd($auteur, $message, $idBlog);
        $req = $connexion->prepare('INSERT INTO commentaire SET auteur = ?, message = ?, date = Now(), valider = false, blog_id = ? ');
        $req->execute(array(
            $auteur,
            $message,
            $idBlog 
        ));
        return $req;
    }


    public function listeDesCommentaires()
    {
        $connexion = $this-> connexionBdd();
        $req = $connexion->query('SELECT * FROM commentaire WHERE valider = false  ORDER BY id ASC ');
        return $req;
    }

    public function validerCommentaire($idCommentaire)
    {
        $connexion = $this-> connexionBdd($idCommentaire);
        $req = $connexion->prepare('UPDATE commentaire SET valider = true WHERE id = ?');
        $req->execute(array(
            $idCommentaire
        ));
        return $req;
    }

    public function supprimerCommentaire($idCommentaire)
    {
        $connexion = $this-> connexionBdd($idCommentaire);
        $req = $connexion->prepare('DELETE FROM commentaire WHERE id = ?');
        $req->execute(array(
            $idCommentaire
        ));
        return $req;
    }

    public function supprimerCommentairesDuBlog($idBlog)
    {
        $connexion = $this-> connexionBdd($idBlog);
        $req = $connexion->prepare('DELETE FROM commentaire WHERE blog_id = ?');
        $req->execute(array(
            $idBlog
        ));
        return $req;
    }


}