<?php

namespace App\Controller;

use App\Model\FunctionsSql;

class Controller
{
    
    private  $twig;

    public  function __construct($twig)
    {
        $this->twig =$twig;
    }

    public function accueil()
    {
        $lesDerniersBlogs = new FunctionsSql;
        echo $this->twig->render('visiteur/accueil.twig',["lesDerniersBlogs" => $lesDerniersBlogs-> lesDerniersBlogs(), "sessionAuteur" =>$_SESSION["auteur"]]);
    }

    public function blogs()
    {
        $listeDesBlogs = new FunctionsSql();
        echo $this->twig->render('visiteur/blogs.twig',["listeDesBlogs" => $listeDesBlogs -> listeDesBlogs()]);
    }

    public function blog()
    {
        $blog = new FunctionsSql;
        $idBlog  = isset($_GET['numero']) ? $_GET['numero'] : NULL;

        echo $this->twig->render('visiteur/blog.twig',["blog"=> $blog ->blog($idBlog)]);
    }

    public function connexion()
    {
        $connexionManager = new FunctionsSql;
        $email  = isset($_POST['email']) ? $_POST['email'] : NULL;
	    $connexion = $connexionManager-> connexionAdministrateur($email);
        require "public/functions/connexion.php";

        echo $this->twig->render('visiteur/connexion.twig');
    }

    public function inscription()
    {
        $inscriptionManager = new FunctionsSql();
        require "public/functions/inscription.php";

        echo $this->twig->render('visiteur/inscription.twig');
    }


    /* Espace ADMINISTRATION */

    public function ajouterUnBlog()
    {
        require "public/functions/verificationConnexion.php";
        $ajouterBlogManager = new FunctionsSql;
        require "public/functions/ajouterBlog.php";

        echo $this->twig->render('admin/ajouterBlog.twig',["messageServeur" => $messageServeur]);
    }

 
    public function modifierBlogs()
    {
        require "public/functions/verificationConnexion.php";
        $listeDesBlogs = new FunctionsSql();

        echo $this->twig->render('admin/modifierBlogs.twig',["listeDesBlogs" => $listeDesBlogs -> listeDesBlogs()]);
    }



    public function modifierBlog()
    {
        require "public/functions/verificationConnexion.php";
        $blog = new FunctionsSql;
        $idBlog  = isset($_GET['numero']) ? $_GET['numero'] : NULL;

        $modifierBlogManager = new FunctionsSql;
        require "public/functions/modifierBlog.php";

        $supprimerBlogManager = new FunctionsSql;
        require "public/functions/supprimerBlog.php";
        
        echo $this->twig->render('admin/modifierBlog.twig',["blog"=> $blog ->blog($idBlog),"messageServeur" => $messageServeur ]);
    }

}