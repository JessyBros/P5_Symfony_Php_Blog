<?php
namespace App\Controller;

use App\Model\BlogManager;
use App\Services\VerificationConnexion;
use App\Services\VerificationFichierImage;
use App\Services\SessionObject;


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
        
        $session = new SessionObject();
        $auteur = filter_var($session->admin['admin']);
        $titre = filter_input(INPUT_POST, 'titre');
        $chapo= filter_input(INPUT_POST, 'chapo');
        $contenu= filter_input(INPUT_POST, 'contenu');
        $image  = isset($_FILES['image']) ? $_FILES['image'] : NULL;
            
        $verificationFichierImage = new VerificationFichierImage;
        $messageServeur = $verificationFichierImage ->verificationFichierImage($image);

        if (!filter_input(INPUT_POST, 'submit')) {
            $messageServeur = "";
        } elseif ($messageServeur != "imageValider") {
            // affiche le message d'erreur lié à la vérification d'image.
        } else{
            $this->blogManager -> ajouterBlog($titre, $auteur, $chapo, $contenu, $image['name']);
            $messageServeur ='<p id="messageServeurTrue">Le blog a bien été enregistré avec succès !</p>';
        }

        echo $this->twig->render('admin/ajouterBlog.twig',["messageServeur" => $messageServeur]);
    }
}