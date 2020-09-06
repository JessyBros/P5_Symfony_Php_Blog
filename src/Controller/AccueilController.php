<?php
namespace App\Controller;

use App\Model\BlogManager;
use App\Services\Mail;

class AccueilController
{    
    private $twig;
    private $blogManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->blogManager = new BlogManager;
    }

    public function accueil()
    {
        if (!filter_input(INPUT_POST, 'submit')) {
            $messageServeur="";
        } else {
            $mail = new Mail;
            $messageServeur = $mail-> mailform();
        }
        
        echo $this->twig->render('visiteur/accueil.twig',["lesDerniersBlogs" => $this->blogManager-> lesDerniersBlogs(),"messageServeur" => $messageServeur]);
    }
   
}







