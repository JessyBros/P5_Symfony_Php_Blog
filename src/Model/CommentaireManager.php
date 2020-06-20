<?php
namespace App\Model;

use App\Entity\Commentaire;
use PDO;

class CommentaireManager extends Manager
{
    // AFFICHE LES COMMENTAIRES VALIDER SELON LE BLOG-> GET['ID']
    public function commentairesBlog($blog_id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM commentaire WHERE blog_id = ? AND valider = true ORDER BY date DESC');
        $req->execute(array($blog_id));
        while($data = $req ->fetch(PDO::FETCH_ASSOC)){
            $var[] = new Commentaire($data);
        }
        if(empty($var)){
            return null;
        }
        return $var;
        $req->closeCursor();

    }
  
    
    // AJOUTER UN COMMENTAIRE
    public function ajouterCommentaire($auteur, $message, $blog_id)
    {
        $req = $this->getBdd()->prepare('INSERT INTO commentaire SET auteur = ?, message = ?, date = Now(), valider = false, blog_id = ? ');
        $req->execute(array(
            $auteur,
            $message,
            $blog_id
        ));
        return $req;
        $req->closeCursor();
    }


    // RETOURNE TOUS LES COMMENTAIRES NON VALIDES
    public function listeDesCommentaires()
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM commentaire WHERE valider = false  ORDER BY id ASC ');
        $req->execute();
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Commentaire($data);
        }
        return $var;
    }

    // VALIDER UN COMMENTAIRE
    public function validerCommentaire($idCommentaire)
    {
        $req = $this->getBdd()->prepare('UPDATE commentaire SET valider = true WHERE id = ?');
        $req->execute(array(
            $idCommentaire
        ));
        return $req;
        $req->closeCursor();
    }
    
    // SUPPRESSION DU COMMENTAIRE
    public function supprimerCommentaire($idCommentaire)
    {
        $req = $this->getBdd()->prepare('DELETE FROM commentaire WHERE id = ?');
        $req->execute(array(
            $idCommentaire
        ));
        return $req;
        $req->closeCursor();
    }

    // SUPPRIME LES COMMENTAIRES DU BLOGS ASSOCIES
    public function supprimerCommentairesDuBlog($id)
    {
        $req = $this->getBdd()->prepare('DELETE FROM commentaire WHERE blog_id = ?');
        $req->execute(array(
            $id
        ));
        return $req;
        $req->closeCursor();
    }


}