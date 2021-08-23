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

/* modules/custom/movie/templates/exporter-page.html.twig */
class __TwigTemplate_e072521355e02065a49fe96fbedca123b3ada2f27a32dd3bf8221b4d21529b7b extends \Twig\Template
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
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<h1>Exporter page:</h1>
<br>
<form action=\"/movie-exporter-processing\" method=\"get\">
  <label for=\"extensionType\">Choose file type:</label>
  <select name=\"extensionType\" id=\"extensionType\">
    <option value=\"csv\">csv</option>
    <option value=\"xml\">xml</option>
  </select>
  <button>Submit</button>
</form>
";
    }

    public function getTemplateName()
    {
        return "modules/custom/movie/templates/exporter-page.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<h1>Exporter page:</h1>
<br>
<form action=\"/movie-exporter-processing\" method=\"get\">
  <label for=\"extensionType\">Choose file type:</label>
  <select name=\"extensionType\" id=\"extensionType\">
    <option value=\"csv\">csv</option>
    <option value=\"xml\">xml</option>
  </select>
  <button>Submit</button>
</form>
", "modules/custom/movie/templates/exporter-page.html.twig", "C:\\xampp\\htdocs\\drupal_first_test\\modules\\custom\\movie\\templates\\exporter-page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array();
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
