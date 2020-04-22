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

/* visiteur/blog.twig */
class __TwigTemplate_8ae504e12c08c710e3d2d8abdc9a07466d21cabf01ba49b4b10c8a6839a21d8d extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.twig", "visiteur/blog.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "

<h1>Mon Blog </h1>


<p> ";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["blog"] ?? null), "id", [], "any", false, false, false, 9), "html", null, true);
        echo "</p>
<p> ";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["blog"] ?? null), "titre", [], "any", false, false, false, 10), "html", null, true);
        echo "</p>
<p> ";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["blog"] ?? null), "chapo", [], "any", false, false, false, 11), "html", null, true);
        echo "</p>
<p> ";
        // line 12
        echo twig_get_attribute($this->env, $this->source, ($context["blog"] ?? null), "contenu", [], "any", false, false, false, 12);
        echo "</p>
<p> ";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["blog"] ?? null), "date", [], "any", false, false, false, 13), "html", null, true);
        echo "</p>
<img src=\"public/images/blogs/";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["blog"] ?? null), "image", [], "any", false, false, false, 14), "html", null, true);
        echo "\" />
<p> ";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["blog"] ?? null), "dateMiseAJour", [], "any", false, false, false, 15), "html", null, true);
        echo "</p>


";
    }

    public function getTemplateName()
    {
        return "visiteur/blog.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 15,  77 => 14,  73 => 13,  69 => 12,  65 => 11,  61 => 10,  57 => 9,  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "visiteur/blog.twig", "C:\\wamp64\\www\\P5_Symfony_Php_Blog\\templates\\visiteur\\blog.twig");
    }
}
