<?php
require "vendor/autoload.php";
require "controller/frontend.php";


switch ($_GET['action']) {

	case 'accueil':
		accueil();
		break;

	case 'blogs':
		blogs();
		break;

	default:
		accueil();
		break;
}