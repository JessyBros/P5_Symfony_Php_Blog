<?php
require "vendor/autoload.php";
require "controller/controller.php";

switch ($_GET['action']) {

	case 'accueil':
		accueil();
		break;

	case 'blogs':
		blogs();
		break;

		case 'blog':
		blog();		
		break;

	default:
		accueil();
		break;
}