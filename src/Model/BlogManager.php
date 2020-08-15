<?php
namespace App\Model;

use App\Entity\Blog;
use PDO;

class BlogManager extends Manager
{
    public function lesDerniersBlogs()
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM blog  ORDER BY id DESC  LIMIT 4 ');
        $req->execute();
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Blog($data);
        }
        return $var;
        $req->closeCursor();
    }

     public function listeDesBlogs()
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM blog  ORDER BY id ASC ');
        $req->execute();
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Blog($data);
        }
        return $var;
        $req->closeCursor();
    }

    public function blog($id)
    {        
        $req = $this->getBdd()->prepare('SELECT * FROM blog WHERE id= ?');
        $req->execute(array(
            $id    
        ));
        $data = $req ->fetch(PDO::FETCH_ASSOC);
        $var = new Blog($data);
        return $var;
        $req->closeCursor();
    }

    // RÉCUPÈRE LE NUMERO ID DU DERNIER BLOG CRÉER
    public function  numeroDernierBlog()
    { 
        $req = $this->getBdd()->prepare('SELECT id FROM blog ORDER BY id DESC Limit 1');
        $req->execute();
        $data = $req ->fetch(PDO::FETCH_ASSOC);
        $var = new Blog($data);
        return $var;
        $req->closeCursor();
    }

    // Parcours tous les blogs existants [Utilisé pour accéder au blog suivant ou précédent]
    public function blogArray()
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT id, titre FROM blog');
        $req->execute([]);
        while($data = $req ->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new Blog($data);
        }         
         return $var;
         $req->closeCursor();
    }
   
    public function ajouterBlog($titre, $auteur, $chapo, $contenu, $image)
    {
        $req = $this->getBdd()->prepare('INSERT INTO blog SET titre = ?, auteur = ?, chapo = ?, contenu = ?, date = Now() , image = ? ');
        $req->execute(array(
            $titre,
            $auteur,
            $chapo,
            $contenu,
            $image
        ));
        return $req;
        $req->closeCursor();
    }

    public function modifierBlog($titre, $chapo, $contenu,$id)
    {
        $req = $this->getBdd()->prepare('UPDATE blog SET titre = ?, chapo = ?, contenu = ?, dateMiseAJour = Now() WHERE id= ?');
        $req->execute(array(
            $titre,
            $chapo,
            $contenu,
            $id
        ));
        return $req;
        $req->closeCursor();
    }
 
    public function supprimerBlog($id)
    {
        $req = $this->getBdd()->prepare('DELETE FROM blog WHERE id = ?');
        $req->execute(array(
            $id
        ));
        return $req;
        $req->closeCursor();
    }
}
