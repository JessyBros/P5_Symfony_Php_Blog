<?php

require "controller/controller.php";

require_once "vendor/autoload.php";

/* Je vais chercher les fichiers dans le dossier templates */
$loader = new Twig_Loader_Filesystem(__DIR__ . "/templates");

/* J'appel l'environnement twig */
$twig = new \Twig\Environment($loader,[
	'cache' => false /*__DIR__ . '/tmp'*/]);


	/* class Routeur{

		public $twig = 5;

		public function __construct($twig){
			$this->twig = $twig;
		}
	
		
		
	$twigs = new Routeur($twig);
	}  
	*/


	


		switch ($_GET['action']) {
		
			case 'accueil':
		
				$test = new Controller;
				$test -> accueil($twig);
				break;
		
			case 'blogs':
				$test = new Controller;
				$test ->blogs($twig);
				break;
		
				case 'blog':
					$test = new Controller;
					$test ->blog($twig);
				break;
		
				case 'connexion':
					$test = new Controller;
					$test ->connexion($twig);
				break;
		
				case 'inscription':
					$test = new Controller;
					$test ->inscription($twig);
				break;
		
				case 'ajouter-un-blog';
				$test = new Controller;
				$test ->ajouterUnBlog($twig);
				break;
		
				default:
				header('HTTP/1.0 404 Not Found');
				echo $twig->render('404.twig');
				break;
		
		
		
			}