<?php ob_start(); ?>

Je suis toujours dans la page d'accueil;

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>