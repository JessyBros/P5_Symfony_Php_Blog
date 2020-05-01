<?php

namespace App\Model;

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

    public function commentairesBlog($idBlog)
    {
        $connexion = $this-> connexionBdd($idBlog);
        $req = $connexion->prepare('SELECT * FROM commentaire WHERE blog_id = ? ORDER BY date DESC');
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


    public function listeVisiteursInscrits()
    {
        $connexion = $this-> connexionBdd();
        $req = $connexion->query('SELECT * FROM visiteur');
        return $req;
    }

    public function supprimerVisiteur($idVisiteur)
    {
        $connexion = $this-> connexionBdd($idVisiteur);
        $req = $connexion->prepare('DELETE FROM visiteur WHERE id = ?');
        $req->execute(array(
            $idVisiteur
        ));
        return $req;
    }

    public function confirmerVisiteur($nom, $prenom, $email, $motDePasse)
    {
        $connexion = $this-> connexionBdd($nom, $prenom, $email, $motDePasse);
        $req = $connexion->prepare( 'INSERT INTO administrateur SET nom = ?, prenom = ?, email = ?, motDePasse = ?');
        $req->execute(array(
            $nom,
            $prenom,
            $email,
            $motDePasse
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
