<?php

require('model/Autoloader.php');
Autoloader::register();


class Controller {


    public function accueil($twig)
    {
        $lesDerniersBlogs = new FunctionsSql;

        echo $twig->render('visiteur/accueil.twig',["lesDerniersBlogs" => $lesDerniersBlogs-> lesDerniersBlogs(), "sessionID" =>$_SESSION["id"]]);
    }

    public function blogs($twig)
    {
        $listeDesBlogs = new FunctionsSql();

        echo $twig->render('visiteur/blogs.twig',["listeDesBlogs" => $listeDesBlogs -> listeDesBlogs()]);
    }

    public function blog($twig)
    {
        $blog = new FunctionsSql;
        $idBlog  = isset($_GET['numero']) ? $_GET['numero'] : NULL;

        echo $twig->render('visiteur/blog.twig',["blog"=> $blog ->blog($idBlog)]);
    }

    public function connexion($twig)
    {
        $connexionManager = new FunctionsSql;
        $email  = isset($_POST['email']) ? $_POST['email'] : NULL;
	    $connexion = $connexionManager-> connexionAdministrateur($email);
        require "public/functions/connexion.php";

        echo $twig->render('visiteur/connexion.twig');
    }

    public function inscription($twig)
    {
        $inscriptionManager = new FunctionsSql();
        require "public/functions/inscription.php";

        echo $twig->render('visiteur/inscription.twig');
    }



    /* Espace ADMINISTRATION*/
    public function ajouterUnBlog($twig)
    {
        require "public/functions/verificationConnexion.php";
        $ajouterBlogManager = new FunctionsSql;
        require "public/functions/ajouterBlog.php";

        echo $twig->render('admin/ajouterBlog.twig',["messageServeur" => $messageServeur]);
    }

 
    public function modifierBlogs($twig)
    {
        require "public/functions/verificationConnexion.php";
        $listeDesBlogs = new FunctionsSql();

        echo $twig->render('admin/modifierBlogs.twig',["listeDesBlogs" => $listeDesBlogs -> listeDesBlogs()]);
    }



    public function modifierBlog($twig)
    {
        require "public/functions/verificationConnexion.php";
        $blog = new FunctionsSql;
        $idBlog  = isset($_GET['numero']) ? $_GET['numero'] : NULL;

        $modifierBlogManager = new FunctionsSql;
        require "public/functions/modifierBlog.php";

        $supprimerBlogManager = new FunctionsSql;
        require "public/functions/supprimerBlog.php";
        
        echo $twig->render('admin/modifierBlog.twig',["blog"=> $blog ->blog($idBlog),"messageServeur" => $messageServeur ]);
    }



}