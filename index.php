<?php
require "vendor/autoload.php";
require "controller/frontend.php";



switch ($_GET['action']) {

	case 'accueil':
		accueil();
		break;

	case 'listeBlog':
		listeBlog();
		break;

	default:
		accueil();
		break;
}