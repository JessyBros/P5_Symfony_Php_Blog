<?php
namespace App\Controller;

class ErrorController
{    
    private $twig;

    public  function __construct($twig)
    {
        $this->twig =$twig;
    }

    public function error404()
    {       
        print_r($this->twig->render('error/404.twig'));
    }
}






