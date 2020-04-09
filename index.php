<?php
require "controller/frontend.php";

switch ($_GET['action']) {

	case 'home':
		echo "page d'accueil";
		break;

	case 'listeBlog':
		echo "Liste des blogs";
		break;



	default:
		echo "page d'accueil";
		break;
}
