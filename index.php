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

	default:
		accueil();
		break;
}