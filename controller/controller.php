<?php

require('model/Autoloader.php');
Autoloader::register();

function accueil()
{

    $lesDerniersBlogsManager = new FunctionsSql();
    $lesDerniersBlogs = $lesDerniersBlogsManager -> lesDerniersBlogs();

    require "view/viewAccueil.php";

}

 function blogs()
 {
    $listeDesBlogsManager = new FunctionsSql();
    $listeDesBlogs = $listeDesBlogsManager -> listeDesBlogs();

    require "view/viewBlogs.php";

}
 

function blog()
{

$blogManager = new FunctionsSql;
$idBlog  = isset($_GET['numero']) ? $_GET['numero'] : NULL;
$blog = $blogManager-> blog($idBlog);

require "view/viewBlog.php";
}