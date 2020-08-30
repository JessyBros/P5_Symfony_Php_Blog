<?php
namespace App\Controller;

use App\Model\BlogManager;
use App\Services\VerificationConnexion;
use App\Services\VerificationFichierImage;

class AjouterUnBlogController
{    
    private $twig;
    private $blogManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->blogManager = new BlogManager;
    }

    public function ajouterUnBlog()
    {
        $verificationConnexion = new VerificationConnexion;
        $verificationConnexion->verificationConnexion($this->twig);
        
        $titre = filter_input(INPUT_POST, 'titre');
        $auteur = filter_var($_SESSION['admin']);
        $chapo= filter_input(INPUT_POST, 'chapo');
        $contenu= filter_input(INPUT_POST, 'contenu');
        $image  = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : NULL;
            
        $verificationFichierImage = new VerificationFichierImage;
        $verificationFichierImage ->verificationFichierImage();

        $messageServeur = isset($GLOBALS['$messageServeur']) ? $GLOBALS['$messageServeur'] : NULL;
        $imageValider = isset($GLOBALS['$imageValider']) ? $GLOBALS['$imageValider'] : NULL;

        if (! isset($_POST["submit"])) {
            $messageServeur = "";
        } elseif (!$imageValider) {
            // affiche le message d'erreur lié à la vérification d'image.
        } else{
            $this->blogManager -> ajouterBlog($titre, $auteur, $chapo, $contenu, $image);
            $messageServeur ='<p id="messageServeurTrue">Le blog a bien été enregistré avec succès !</p>';
        }

        echo $this->twig->render('admin/ajouterBlog.twig',["messageServeur" => $messageServeur]);
    }
}







