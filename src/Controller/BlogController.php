<?php
namespace App\Controller;

use App\Model\BlogManager;
use App\Model\CommentaireManager;
use App\Services\VerificationBlogExistant;

class BlogController extends VerificationBlogExistant
{    
    private $twig;
    private $blogManager;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->blogManager = new BlogManager;
    }
   
    public function blog($matches)
    {
        $id = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);
        $blog_id = filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT);

        $commentaireManager = new CommentaireManager;

        //Dernier Blog pour previous et next
        $numeroDernierBlog = $this->blogManager ->numeroDernierBlog();

        // parcours tous les blogs crées
        $blogArray = $this->blogManager ->blogArray($id);
        
        // récupère le blog selon l'id actuel pour crée la pagination previous et next
        for($i =0; $i < count($blogArray); $i++) {
            if($id == $blogArray[$i]->getId()) {
                if ($i == 0) {
                    $previous = 99;
                    $next = $blogArray[$i+1]->getId();
                }
                if ($i == count($blogArray)-1) {
                    $previous = $blogArray[$i-1]->getId();
                    $next = 99;
                } elseif ($i != 0 && $i != count($blogArray)-1){
                    $previous = $blogArray[$i-1]->getId();
                    $next = $blogArray[$i+1]->getId();
                }
            }
        }

        // Vérifie si le blog existe
        $this->verificationBlogExistant($numeroDernierBlog->getId(), $id);

        // début ajouter un commentaire   
        if (isset($_POST["submit"])) {
            $auteur  = filter_input(INPUT_POST, 'auteur');
            $message  = filter_input(INPUT_POST, 'message');
            
            $ajouterCommentaire = $commentaireManager -> ajouterCommentaire($auteur, $message, $blog_id);
            
            if ($ajouterCommentaire) {
                $messageServeur = '<p id="messageServeurTrue">Le commentaire a bien été enregistré avec succès en attente de confirmation ! </p>';
            } else {
                $messageServeur = '<p id="messageServeur">Erreur lors de l\'ajout du commentaire ! </p>';
            }		
        } else {
            $messageServeur = "";
        }	
        // fin ajouter un commentaire
            
        echo $this->twig->render('visiteur/blog.twig',["next"=>$next, "previous"=>$previous,"blog"=> $this->blogManager ->blog($id),"numeroDernierBlog"=> $this->blogManager ->numeroDernierBlog(), "commentairesValider" =>$commentaireManager->commentairesValider($blog_id),"messageServeur" => $messageServeur]);
    }



    // VERIFIE SI LE BLOG EXISTE
    
   
}







