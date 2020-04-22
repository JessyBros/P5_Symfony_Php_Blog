<?php
session_start();


require "controller/controller.php";

require_once "vendor/autoload.php";

/* Je vais chercher les fichiers dans le dossier templates */
$loader = new Twig_Loader_Filesystem(__DIR__ . "/templates");
$twig = new \Twig\Environment($loader,[
	'cache' => false /*__DIR__ . '/tmp'*/]);

	/* add session */
$twig->addGlobal('session', $_SESSION);

		switch ($_GET['action']) {
		
			case 'accueil':
		
				$page = new Controller;
				$page -> accueil($twig);
				break;
		
				case 'blogs':
				$page = new Controller;
				$page ->blogs($twig);
				break;
		
				case 'blog':
				$page = new Controller;
				$page ->blog($twig);
				break;
		
				case 'connexion':
				$page = new Controller;
				$page ->connexion($twig);
				break;
		
				case 'inscription':
				$page = new Controller;
				$page ->inscription($twig);
				break;
		
				case 'ajouter-un-blog';
				$page = new Controller;
				$page ->ajouterUnBlog($twig);
				break;

				case 'modifier-blogs':
				$page = new Controller;
				$page ->modifierBlogs($twig);
				break;

				case 'modifier-blog':
				$page = new Controller;
				$page ->modifierBlog($twig);
				break;
		
				default:
				header('HTTP/1.0 404 Not Found');
				echo $twig->render('404.twig');
				break;
		
		
		
			}