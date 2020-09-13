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
        print_r($this->twig->render('visiteur/blogs.twig',["listeDesBlogs" => $this->blogManager -> listeDesBlogs()]));
    }
  
}







