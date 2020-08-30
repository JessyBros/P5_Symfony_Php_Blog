<?php
namespace App\Controller;

use App\Model\BlogManager;

class ListeDesBlogsController
{    
    private $twig;
    private $blogManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->blogManager = new BlogManager;
    }

    public function listeDesBlogs()
    {
        echo $this->twig->render('visiteur/blogs.twig',["listeDesBlogs" => $this->blogManager -> listeDesBlogs()]);
    }
  
}







