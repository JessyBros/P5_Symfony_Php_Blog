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
        if (!isset($_POST['submit'])) {
            $messageServeur="";
        } else {
            $mail = new Mail;
            $mail-> mailform();
            $messageServeur = isset($GLOBALS['$messageServeur']) ? $GLOBALS['$messageServeur'] : NULL;
        }
        
        echo $this->twig->render('visiteur/accueil.twig',["lesDerniersBlogs" => $this->blogManager-> lesDerniersBlogs(),"messageServeur" => $messageServeur]);
    }
   
}







