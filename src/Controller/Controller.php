<?php

namespace App\Controller;

use App\Model\Blog;
use App\Model\Commentaire;
use App\Model\Utilisateur;

class Controller
{
    
    private  $twig;

    public  function __construct($twig)
    {
        $this->twig =$twig;
    }

    public function accueil()
    {
        $lesDerniersBlogs = new Blog;

        require "public/functions/contactMail.php";

        echo $this->twig->render('visiteur/accueil.twig',["lesDerniersBlogs" => $lesDerniersBlogs-> lesDerniersBlogs()]);
    }

    public function blogs()
    {
        $listeDesBlogs = new Blog();
        echo $this->twig->render('visiteur/blogs.twig',["listeDesBlogs" => $listeDesBlogs -> listeDesBlogs()]);
    }

    public function blog()
    { 
        $idBlog  = isset($_GET['numero']) ? $_GET['numero'] : NULL;

        $blog = new Blog;
        $numeroDernierBlog = new Blog;

        $ajouterCommentaireManager = new Commentaire;
        require "public/functions/ajouterCommentaire.php";

        $commentairesBlog = new Commentaire;
        
        echo $this->twig->render('visiteur/blog.twig',["blog"=> $blog ->blog($idBlog),"numeroDernierBlog"=> $numeroDernierBlog ->numeroDernierBlog(), "commentairesBlog" =>$commentairesBlog->commentairesBlog($idBlog),"messageServeur" => $messageServeur]);
    }

    public function connexion()
    {
        $connexionManager = new Utilisateur;
        $email  = isset($_POST['email']) ? $_POST['email'] : NULL;
	    $connexion = $connexionManager-> connexionAdministrateur($email);
        require "public/functions/connexion.php";

        echo $this->twig->render('visiteur/connexion.twig',["messageServeur" => $messageServeur]);
    }

    public function inscription()
    {
        $inscriptionManager = new Utilisateur();
        require "public/functions/inscription.php";

        echo $this->twig->render('visiteur/inscription.twig',["messageServeur" => $messageServeur]);
    }


    /* Espace ADMINISTRATION */

    public function ajouterUnBlog()
    {
        require "public/functions/verificationConnexion.php";
        $ajouterBlogManager = new Blog;
        require "public/functions/ajouterBlog.php";

        echo $this->twig->render('admin/ajouterBlog.twig',["messageServeur" => $messageServeur]);
    }

 
    public function modifierBlogs()
    {
        require "public/functions/verificationConnexion.php";
        $listeDesBlogs = new Blog();

        echo $this->twig->render('admin/modifierBlogs.twig',["listeDesBlogs" => $listeDesBlogs -> listeDesBlogs()]);
    }



    public function modifierBlog()
    {
        require "public/functions/verificationConnexion.php";
        $blog = new Blog;
        $idBlog  = isset($_GET['numero']) ? $_GET['numero'] : NULL;

        $modifierBlogManager = new Blog;
        require "public/functions/modifierBlog.php";

        $supprimerBlogManager = new Blog;
        $supprimerCommentairesDuBlogManager = new Commentaire;
        require "public/functions/supprimerBlog.php";

       
        
        echo $this->twig->render('admin/modifierBlog.twig',["blog"=> $blog ->blog($idBlog),"messageServeur" => $messageServeur]);
    }

    public function commentaires()
    {
        require "public/functions/verificationConnexion.php";

        $listeDesCommentaires = new Commentaire;

        $idCommentaire = isset($_POST['idCommentaire']) ? $_POST['idCommentaire'] : NULL;
        $validerCommentaireManager = new Commentaire;
        $supprimerCommentaireManager = new Commentaire;
        require "public/functions/validerCommentaire.php";

        echo $this->twig ->render('admin/commentaires.twig',["listeDesCommentaires" => $listeDesCommentaires ->listeDesCommentaires(),"messageServeur" => $messageServeur]);

    }

    public function utilisateurs()
    {
        $listeUtilisateursInscrits = new Utilisateur;
        
        $supprimerUtilisateurManager = new Utilisateur;
        $confirmerUtilisateurManager = new Utilisateur;
        require "public/functions/validerUtilisateur.php";

        echo $this->twig ->render('admin/utilisateurs.twig',["listeUtilisateursInscrits" => $listeUtilisateursInscrits ->listeUtilisateursInscrits(),"messageServeur" => $messageServeur]);
    }

}