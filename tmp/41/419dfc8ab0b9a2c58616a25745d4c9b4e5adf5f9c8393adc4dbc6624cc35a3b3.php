<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* viewAccueil.twig */
class __TwigTemplate_cde61ad4d271e2a617e4077fb4b67e7d549fce6ad745ca497d213c13ac5dfb15 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<?php ob_start(); ?>

<section id=\"presentation\">

\t<h1>Développeur web</h1>
\t<p>Un développeur qui transcende les limites !</p>

\t<div>
\t\t<img src=\"\" alt=\"Photo de jessy | Blog développeur web\">
\t\t<p><strong>Jessy BROS - </strong>Développeur web Développeurweb Back-end </p>
\t</div>

\t<div>
\t\t<p><strong>Études : </strong>Formation chez Openclassrooms: Développeur d'application - PHP / Symfony</p>
\t\t<img src=\"\" alt=\"logo openclassrooms\">
\t</div>

</section>

<section id=\"blogs\">

\t<h2>Les derniers blogs</h2>

\t     <?php  foreach (\$lesDerniersBlogs as \$blog ): ?>

\t\t\t<article> Blog <?= htmlspecialchars(\$blog['id']) ?></article>

\t\t<?php endforeach; ?>

\t<button>Voir tous les blogs existants</button>

</section>

<section id=\"contact_form\">
<h2>Contactez-moi</h2>
<form action=\"mailto:j.bros@hotmail.fr\" method=\"post\">

\t<label for=\"nom\">Nom/Prénom</label>
\t<input type=\"text\" name=\"nom\" placeholder=\"Votre Nom\" id=\"nom\"><br>

\t<label for=\"email\">Email</label>
\t<input type=\"email\" name=\"email\" placeholder=\"adresse@domaine.com\" id=\"email\"><br>

\t<label for=\"message\">Message</label>

<textarea id=\"message\" rows=\"4\" cols=\"50\" placeholder=\"Votre message...\"></textarea><br>

\t<input type=\"submit\" name=\"submit\" id=\"submit\" value\"Envoyer\"><br>

</form>

</section>

<?php \$content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>";
    }

    public function getTemplateName()
    {
        return "viewAccueil.twig";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "viewAccueil.twig", "C:\\wamp64\\www\\P5_Symfony_Php_Blog\\templates\\viewAccueil.twig");
    }
}
