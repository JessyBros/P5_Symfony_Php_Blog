<?php ob_start(); ?>

<h1>test</h1>


<p><?= $blog['id'];?></p>
<p><?= $blog['titre'];?></p>
<p><?= $blog['chapo'];?></p>
<p><?= $blog['contenu'];?></p>
<p><?= $blog['date'];?></p>
<p><?= $blog['image'];?></p>
<p><?= $blog['dateMiseAJour'];?></p>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>