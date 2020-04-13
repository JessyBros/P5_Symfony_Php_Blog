<?php ob_start(); ?>

Je suis toujours dans la page de mes différents blogs ;)

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>