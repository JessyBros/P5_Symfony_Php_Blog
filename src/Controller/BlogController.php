<?php
namespace App\Controller;

use PDO;
use App\Model\BlogManager;
use App\Model\CommentaireManager;
use App\Services\Mail;
use App\Services\VerificationConnexion;
use App\Services\VerificationFichierImage;

class BlogController
{    
    private $twig;

    public  function __construct($twig)
    {
        $this->twig =$twig;
        $this->blogManager = new BlogManager;
    }

    public function accueil()
    {
        if (isset($_POST['submit'])) {
            $mail = new Mail;
            $mail-> mailform();
            $messageServeur = isset($GLOBALS['$messageServeur']) ? $GLOBALS['$messageServeur'] : NULL;
        } else {
            $messageServeur="";
        }
        
        echo $this->twig->render('visiteur/accueil.twig',["lesDerniersBlogs" => $this->blogManager-> lesDerniersBlogs(),"messageServeur" => $messageServeur]);
    }

    public function blogs()
    {
        echo $this->twig->render('visiteur/blogs.twig',["listeDesBlogs" => $this->blogManager -> listeDesBlogs()]);
    }

    public function blog()
    { 
        $id = isset($_GET['numero']) ? $_GET['numero'] : NULL;
        $blog_id = isset($_GET['numero']) ? $_GET['numero'] : NULL;

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
        $this->verificationBlogExistant($numeroDernierBlog->getID());

        // début ajouter un commentaire   
        if (isset($_POST["submit"])) {
            $auteur  = isset($_POST['auteur']) ? $_POST['auteur'] : NULL;
            $message  = isset($_POST['message']) ? $_POST['message'] : NULL;
            
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
            
        echo $this->twig->render('visiteur/blog.twig',["next"=>$next, "previous"=>$previous,"blog"=> $this->blogManager ->blog($id),"numeroDernierBlog"=> $this->blogManager ->numeroDernierBlog(), "commentairesBlog" =>$commentaireManager->commentairesBlog($blog_id),"messageServeur" => $messageServeur]);
    }


    /* Espace ADMINISTRATION */

    public function ajouterUnBlog()
    {
         $verificationConnexion = new VerificationConnexion;
         $verificationConnexion->verificationConnexion();

        // début ajouter un blog
        if (isset($_POST["submit"])) {
            $titre = isset($_POST['titre']) ? $_POST['titre'] : NULL;
            $auteur  = isset($_SESSION['admin']) ? $_SESSION['admin'] : NULL;
            $chapo  = isset($_POST['chapo']) ? $_POST['chapo'] : NULL;
            $contenu  = isset($_POST['contenu']) ? $_POST['contenu'] : NULL;
            $image  = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : NULL;

            $verificationFichierImage = new VerificationFichierImage;
            $verificationFichierImage ->verificationFichierImage();

            $messageServeur = isset($GLOBALS['$messageServeur']) ? $GLOBALS['$messageServeur'] : NULL;
            $imageValider = isset($GLOBALS['$imageValider']) ? $GLOBALS['$imageValider'] : NULL;
            
            if ($imageValider){               
                $this->blogManager -> ajouterBlog($titre, $auteur, $chapo, $contenu, $image);
                $messageServeur ='<p id="messageServeurTrue">Le blog a bien été enregistré avec succès !</p>';
            }
        } else {
            $messageServeur = "";
        }	
        // Fin ajouter un blog

        echo $this->twig->render('admin/ajouterBlog.twig',["messageServeur" => $messageServeur]);
    }

    public function modifierBlogs()
    {
        $verificationConnexion = new VerificationConnexion;
        $verificationConnexion->verificationConnexion();

        echo $this->twig->render('admin/modifierBlogs.twig',["listeDesBlogs" => $this->blogManager -> listeDesBlogs()]);
    }

    public function modifierBlog()
    {
        $verificationConnexion = new VerificationConnexion;
        $verificationConnexion->verificationConnexion();
        $id = isset($_GET['numero']) ? $_GET['numero'] : NULL;
        
        $commentaireManager = new CommentaireManager;

        // Vérifie si le blog existe
        $numeroDernierBlog = $this->blogManager ->numeroDernierBlog();
        $this->verificationBlogExistant($numeroDernierBlog->getId());
        
        // début modifier un blog
        if (isset($_POST["modifier"])) {
            $titre  = isset($_POST['titre']) ? $_POST['titre'] : NULL;
            $chapo  = isset($_POST['chapo']) ? $_POST['chapo'] : NULL;
            $contenu  = isset($_POST['contenu']) ? $_POST['contenu'] : NULL;
            
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
            $pathImage = 'public/images/blogs/' . $image;
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
    private function verificationBlogExistant(int $id)
    {
        if  ($_GET['numero'] < "1" || $_GET['numero'] > $id) {
            if ($_GET["action"] == "blog") {
                header("Location:blogs");
            } elseif ($_GET["action"] == "modifier-blog") {
                header("Location:modifier-blogs");
            } else {
                header("Location: http://localhost/p5_symfony_php_blog");
            } 
        }
    }
    //VERIFIE SI L'UTILISATEUR EST BIEN CONNECTER
}






