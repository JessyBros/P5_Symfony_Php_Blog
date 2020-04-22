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

/* base.twig */
class __TwigTemplate_3a11ac7634b0f040be90f3b879a9f3da9bd04a126a5e96e61ae734930b569fb7 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "﻿<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />
        <title>Jessy BROS | Blog d�veloppeur web</title>
        <link rel=\"icon\" type=\"image/png\" href=\"public/images/logo.png\" />
        <META NAME=\"Description\" CONTENT=\" Bienvenue sur le blog de Jessy BROS, � l'occasion d'un projet de cours.\">
    </head>

    <body>
        <header>
\t        <img style=\"height:100px;\" src=\"public/images/logo.png\" alt=\"logo | Blog d�veloppeur web\"/>
\t        <nav>
\t\t        <a href=\"http://localhost/p5_symfony_php_blog/\">Accueil</a>
\t\t        <a href=\"blogs\">Blogs</a>
\t\t        <a href=\"connexion\">connexion</a>
\t\t        <a href=\"inscription\">inscription</a>
\t        </nav>

        </header>

        ";
        // line 22
        $this->displayBlock('content', $context, $blocks);
        // line 23
        echo "
        <footer>

            <div>
               
               <img style=\"height:100px;\" src=\"public/images/logo.png\" alt=\"logo | Blog d�veloppeur web\"/>
                <ul>

                    <li>
                        <a href=\"https://www.facebook.com/jessy.bros.1\">
                            <i>facebook</i>
                        </a>
                    </li>

                    <li>
                        <a href=\"https://github.com/SiProdZz\">
                            <i>GitHub</i>
                        </a>
                    </li>
                </ul>

            <nav>
                <a href=\"ajouter-un-blog\">Ajouter un blog</a>
                <a href=\"modifier-blogs\">Blogs</a>
            <nav>
                <p>COPYRIGHT � <?php echo date(\"Y\"); ?> - Jessy BROS</p>
            <div>
        </footer>

    </body>
</html>";
    }

    // line 22
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " ";
    }

    public function getTemplateName()
    {
        return "base.twig";
    }

    public function getDebugInfo()
    {
        return array (  97 => 22,  63 => 23,  61 => 22,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "base.twig", "C:\\wamp64\\www\\P5_Symfony_Php_Blog\\templates\\base.twig");
    }
}
