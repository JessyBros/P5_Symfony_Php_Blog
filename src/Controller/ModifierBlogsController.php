<?php
namespace App\Controller;

use App\Model\BlogManager;
use App\Services\VerificationConnexion;

class ModifierBlogsController
{    
    private $twig;
    private $blogManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->blogManager = new BlogManager;
    }

    public function modifierBlogs()
    {
        $verificationConnexion = new VerificationConnexion;
        $verificationConnexion->verificationConnexion($this->twig);

        print_r($this->twig->render('admin/modifierBlogs.twig',["listeDesBlogs" => $this->blogManager -> listeDesBlogs()]));
    }
}







