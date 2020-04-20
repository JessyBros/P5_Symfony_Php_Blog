<?php

require('model/Autoloader.php');
Autoloader::register();


 class Controller {


    public function accueil($twig)
    {
        $lesDerniersBlogs = new FunctionsSql;

         echo $twig->render('accueil.twig',["lesDerniersBlogs" => $lesDerniersBlogs-> lesDerniersBlogs()]);

    }

    public function blogs($twig)
 {
    $listeDesBlogsManager = new FunctionsSql();
    $listeDesBlogs = $listeDesBlogsManager -> listeDesBlogs();

    echo $twig->render('blogs.twig');

}

public function blog($twig)
{

    $blogManager = new FunctionsSql;
    $idBlog  = isset($_GET['numero']) ? $_GET['numero'] : NULL;
    $blog = $blogManager-> blog($idBlog);

    echo $twig->render('blog.twig');
}

public function connexion($twig)
{

    $connexionManager = new FunctionsSql;
    $email  = isset($_POST['email']) ? $_POST['email'] : NULL;
	$connexion = $connexionManager-> connexionAdministrateur($email);

    require "public/functions/connexion.php";

   echo $twig->render('connexion.twig');
}

public function inscription($twig)
{

    $inscriptionManager = new FunctionsSql();

    require "public/functions/inscription.php";

    echo $twig->render('inscription.twig');
}

/* Espace ADMINISTRATION*/
public function ajouterUnBlog($twig)
 {
     echo $twig->render('ajouterBlog.twig');
 }



}