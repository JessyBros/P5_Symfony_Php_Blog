<?php

session_start();
use App\Controller\AccueilController;
use App\Controller\ListeDesBlogsController;
use App\Controller\BlogController;
use App\Controller\ConnexionController;
use App\Controller\InscriptionController;
use App\Controller\DeconnexionController;
use App\Controller\RetrouvezVotreCompteController;
use App\Controller\NouveauMotDePasseController;
use App\Controller\AjouterUnBlogController;
use App\Controller\ModifierBlogsController;
use App\Controller\ModifierBlogController;
use App\Controller\CommentairesController;
use App\Controller\UtilisateursController;
use App\Controller\ErrorController;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . "/../vendor/autoload.php";

/* Je vais chercher les fichiers dans le dossier templates */
$loader = new FilesystemLoader(__DIR__ . "/../templates");

/* Appel l'environnement twig */
$twig = new \Twig\Environment($loader,[
	'cache' => false /*__DIR__ . '/tmp'*/]);

/* Ajout des sessions */
$twig->addGlobal('session', $_SESSION);

$uri = $_SERVER['REQUEST_URI'];
switch ($uri) {
	case "/":
		$controller = new AccueilController($twig);
        $controller -> accueil();
        break;
	case "/liste-des-blogs":
		$controller = new ListeDesBlogsController($twig);
        $controller ->listeDesBlogs();
        break;
	case (preg_match('/^\/blog\-(\d+)$/', $uri, $matches)? true : false):
		$controller = new BlogController($twig);
        $controller ->blog($matches);
		break;
	case '/connexion':
		$controller = new ConnexionController($twig);
        $controller -> connexion();
		break;
	case '/deconnexion':
		$controller = new DeconnexionController($twig);
        $controller -> deconnexion();
		break;
	case '/inscription':
		$controller = new InscriptionController($twig);
        $controller -> inscription();
		break;
	case '/retrouvez-votre-compte':
		$controller = new RetrouvezVotreCompteController($twig);
        $controller -> retrouvezVotreCompte();
		break;
	case (preg_match('/^\/nouveau\-mot\-de\-passe\-(\d+)\-(\D+)$/', $uri, $matches)? true : false):
		$controller = new NouveauMotDePasseController($twig);
        $controller -> nouveauMotDePasse($matches);
		break;
	case '/ajouter-un-blog';
		$controller = new AjouterUnBlogController($twig);
        $controller -> ajouterUnBlog();
		break;
	case '/modifier-blogs':
		$controller = new ModifierBlogsController($twig);
        $controller -> modifierBlogs();
		break;
	case (preg_match('/^\/modifier\-blog\-(\d+)$/', $uri, $matches)? true : false):
		$controller = new ModifierBlogController($twig);
        $controller -> modifierBlog($matches);
		break;
	case '/commentaires':
		$controller = new CommentairesController($twig);
        $controller -> commentaires();
		break;
	case '/utilisateurs':
		$controller = new UtilisateursController($twig);
        $controller -> utilisateurs();
		break;
	default:
		$controller = new ErrorController($twig);
		$controller ->error404();
		break;		
}
