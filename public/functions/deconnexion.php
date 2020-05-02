<?php
session_start();
$_SESSION["connecter"] = false;
$_SESSION["id"] = null;
$_SESSION["auteur"] = null;
header("Location:http://localhost/p5_symfony_php_blog");
