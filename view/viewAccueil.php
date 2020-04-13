<?php ob_start(); ?>

<section id="presentation">

	<h1>D�veloppeur web</h1>
	<p>Un d�veloppeur qui transcende les limites !</p>

	<div>
		<img src="" alt="Photo de jessy | Blog d�veloppeur web">
		<p><strong>Jessy BROS - </strong>D�veloppeur web D�veloppeurweb Back-end </p>
	</div>

	<div>
		<p><strong>�tudes : </strong>Formation chez Openclassrooms: D�veloppeur d'application - PHP / Symfony</p>
		<img src="" alt="logo openclassrooms">
	</div>

</section>

<section id="blogs">

	<h2>Les derniers blogs</h2>

	     <?php  foreach ($lesDerniersBlogs as $blog ): ?>

			<article> Blog <?= htmlspecialchars($blog['id']) ?></article>

		<?php endforeach; ?>

	<button>Voir tous les blogs existants</button>

</section>

<section id="contact_form">
<h2>Contactez-moi</h2>
<form action="mailto:j.bros@hotmail.fr" method="post">

	<label for="nom">Nom/Pr�nom</label>
	<input type="text" name="nom" placeholder="Votre Nom" id="nom"><br>

	<label for="email">Email</label>
	<input type="email" name="email" placeholder="adresse@domaine.com" id="email"><br>

	<label for="message">Message</label>

<textarea id="message" rows="4" cols="50" placeholder="Votre message..."></textarea><br>

	<input type="submit" name="submit" id="submit" value"Envoyer"><br>

</form>

</section>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>