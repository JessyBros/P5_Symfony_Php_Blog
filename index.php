<?php
session_start();

use App\Controller\Controller;
use Twig\Loader\FilesystemLoader;

require_once "vendor/autoload.php";

/* Je vais chercher les fichiers dans le dossier templates */
$loader = new FilesystemLoader(__DIR__ . "/templates");

/* Appel l'environnement twig */
$twig = new \Twig\Environment($loader,[
	'cache' => false /*__DIR__ . '/tmp'*/]);

/* add session */
$twig->addGlobal('session', $_SESSION);

$page = new Controller($twig);

		switch ($_GET['action']) {
			case 'accueil':
				$page -> accueil();
				break;
			case 'blogs':
				$page ->blogs();
				break;
			case 'blog':
				$page ->blog();
				break;
			case 'connexion':
				$page ->connexion();
				break;
			case 'inscription':
				$page ->inscription();
				break;
			case 'ajouter-un-blog';
				$page ->ajouterUnBlog();
				break;
			case 'modifier-blogs':
				$page ->modifierBlogs();
				break;
			case 'modifier-blog':
				$page ->modifierBlog();
				break;
			case 'commentaires':
				$page ->commentaires();
				break;
			default:
				header('HTTP/1.0 404 Not Found');
				echo $twig->render('404.twig');
				break;		
		}