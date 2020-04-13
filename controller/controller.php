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

    require "view/viewBlogs.php";

}