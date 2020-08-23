<?php
namespace App\Model;

use App\Entity\Commentaire;
use PDO;

class CommentaireManager extends Manager
{
    public function commentairesValider($blog_id)
    {
        $req = $this->getBdd()->prepare('SELECT * FROM commentaire WHERE blog_id = ? AND commentaire_valider = true ORDER BY date DESC');
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
  
    public function ajouterCommentaire($auteur, $message, $blog_id)
    {
        $req = $this->getBdd()->prepare('INSERT INTO commentaire SET auteur = ?, message = ?, date = Now(), commentaire_valider = false, blog_id = ? ');
        $req->execute(array(
            $auteur,
            $message,
            $blog_id
        ));
        return $req;
        $req->closeCursor();
    }

    public function CommentairesEnAttenteDeValidation()
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM commentaire WHERE commentaire_valider = false  ORDER BY id ASC ');
        $req->execute();
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Commentaire($data);
        }
        return $var;
    }

    public function validerCommentaire($idCommentaire)
    {
        $req = $this->getBdd()->prepare('UPDATE commentaire SET commentaire_valider = true WHERE id = ?');
        $req->execute(array(
            $idCommentaire
        ));
        return $req;
        $req->closeCursor();
    }

    public function supprimerCommentaire($idCommentaire)
    {
        $req = $this->getBdd()->prepare('DELETE FROM commentaire WHERE id = ?');
        $req->execute(array(
            $idCommentaire
        ));
        return $req;
        $req->closeCursor();
    }

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