<?php
namespace App\Controller;

use App\Model\BlogManager;
use App\Model\CommentaireManager;
use App\Services\VerificationConnexion;
use App\Services\VerificationBlogExistant;

class ModifierBlogController
{    
    private $twig;
    private $blogManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->blogManager = new BlogManager;
    }

    public function modifierBlog($matches)
    {
        $verificationConnexion = new VerificationConnexion;
        $verificationConnexion->verificationConnexion($this->twig);
        
        $id = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);
        
        $commentaireManager = new CommentaireManager;

        // Vérifie si le blog existe
        $numeroDernierBlog = $this->blogManager ->numeroDernierBlog();
        $this->verificationBlogExistant($numeroDernierBlog->getId(), $id);
        
        // début modifier un blog
        if (isset($_POST["modifier"])) {
            $titre = filter_input(INPUT_POST, 'titre');
            $chapo  = filter_input(INPUT_POST, 'chapo');
            $contenu   = filter_input(INPUT_POST, 'contenu');
            
            $modifierBlog = $this->blogManager -> modifierBlog($titre, $chapo, $contenu, $id);

            if ($modifierBlog) {
                $messageServeur ='<p id="messageServeurTrue">Le blog a été modifié avec succès ! </p>';
            } else {
                $messageServeur = '<p id="messageServeur">Erreur lors de la modification du blog !</p>';
            }				
        } else {
            $messageServeur ="";
        }
        // fin modifier un blog

        // début supprimer blog
        if (isset($_POST["supprimer"])) {
            $image  = isset($_POST['image']) ? $_POST['image'] : NULL;
            $this->blogManager -> supprimerBlog($id);
            $supprimerCommentairesDuBlog = $commentaireManager -> supprimerCommentairesDuBlog($id);
            $pathImage = 'images/blogs/' . $image;
            if (file_exists($pathImage)) {
                unlink($pathImage);
            }    
            header("Location:modifier-blogs");
        }
        // fin supprimer blog

        echo $this->twig->render('admin/modifierBlog.twig',["blog"=> $this->blogManager ->blog($id),"messageServeur" => $messageServeur]);
    }

// FUNCTIONS SUPPLÉMENTAIRES
    // VERIFIE SI LE BLOG EXISTE
    private function verificationBlogExistant(int $id, int $blog_id)
    {
        if  ($blog_id < "1" || $blog_id > $id) {
            if (preg_match('/^\/blog\-(\d+)$/', $_SERVER['REQUEST_URI'])) {
                header("Location:/liste-des-blogs");
            } elseif (preg_match('/^\/modifier\-blog\-(\d+)$/', $_SERVER['REQUEST_URI'])) {
                header("Location:modifier-blogs");
            } else {
                header("Location:/");
            } 
        }
    }
   
}







