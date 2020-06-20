<?php
session_start();

use App\Controller\BlogController;
use App\Controller\CommentaireController;
use App\Controller\UtilisateurController;
use Twig\Loader\FilesystemLoader;

require_once "vendor/autoload.php";

/* Je vais chercher les fichiers dans le dossier templates */
$loader = new FilesystemLoader(__DIR__ . "/templates");

/* Appel l'environnement twig */
$twig = new \Twig\Environment($loader,[
	'cache' => false /*__DIR__ . '/tmp'*/]);
/* add session */
$twig->addGlobal('session', $_SESSION);

$BlogPage = new BlogController($twig);
$CommentairePage = new CommentaireController($twig);
$UtilisateurPage = new UtilisateurController($twig);

		switch ($_GET['action']) {
			case 'accueil':
				$BlogPage -> accueil();
				break;
			case 'blogs':
				$BlogPage ->blogs();
				break;
			case 'blog':
				$BlogPage ->blog();
				break;
			case 'connexion':
				$UtilisateurPage ->connexion();
				break;
			case 'deconnexion':
				$UtilisateurPage ->deconnexion();
				break;
			case 'inscription':
				$UtilisateurPage ->inscription();
				break;
			case 'retrouvez-votre-compte':
				$UtilisateurPage ->retrouvezVotreCompte();
				break;
			case 'nouveau-mot-de-passe':
				$UtilisateurPage ->nouveauMotDePasse();
				break;
			case 'ajouter-un-blog';
				$BlogPage ->ajouterUnBlog();
				break;
			case 'modifier-blogs':
				$BlogPage ->modifierBlogs();
				break;
			case 'modifier-blog':
				$BlogPage ->modifierBlog();
				break;
			case 'commentaires':
				$CommentairePage ->commentaires();
				break;
			case 'utilisateurs':
				$UtilisateurPage ->utilisateurs();
				break;
			default:
				$BlogPage -> accueil();
				break;		
		}