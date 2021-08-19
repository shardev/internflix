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

/* modules/custom/movie/templates/start-movie-reservation.html.twig */
class __TwigTemplate_b55cfba5bc3651bffb63ebcff2ac73504fe9f6a8459c26be55a713cee0730d03 extends \Twig\Template
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
        echo "<h4>Welcome to our movie reservation page</h4>

<form action=\"#\">
  <label for=\"movie-genre\">
    Please select movie genre for which you would like to make a reservation:
  </label>

  <select name=\"movie-genre\" id=\"movie-genre\">
    <option value=\"0\">All movies</option>
    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
            // line 11
            echo "      <option value=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["genre"], "id", [], "any", false, false, true, 11), 11, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["genre"], "name", [], "any", false, false, true, 11), 11, $this->source), "html", null, true);
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "  </select>
  <button id=\"searchButton\" type=\"button\">Search</button>
</form>
<hr>

<div id=\"moviesByGenre\">
  ";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["movies"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["movie"]) {
            // line 20
            echo "    <br>
    <div class=\"inactive\" id=\"movieitem-";
            // line 21
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["movie"], "id", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
            echo "\">
      <h5>";
            // line 22
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["movie"], "label", [], "any", false, false, true, 22), 22, $this->source), "html", null, true);
            echo "</h5>
      <p> Description: ";
            // line 23
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, strip_tags($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["movie"], "field_description", [], "any", false, false, true, 23), "value", [], "any", false, false, true, 23), 23, $this->source)), "html", null, true);
            echo " </p>
      <img src=\"";
            // line 24
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["movie"], "field_movie_cover_image", [], "any", false, false, true, 24), "entity", [], "any", false, false, true, 24), "fileuri", [], "any", false, false, true, 24), 24, $this->source)]), "html", null, true);
            echo "\" alt=\"\">
      <div>
        Available days:
        ";
            // line 27
            $context["allowed_values"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["movie"], "field_availabile_days", [], "any", false, false, true, 27), "getSetting", [0 => "allowed_values"], "method", false, false, true, 27);
            // line 28
            echo "        ";
            $context["list_values"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["movie"], "field_availabile_days", [], "any", false, false, true, 28), "getValue", [], "method", false, false, true, 28);
            // line 29
            echo "        ";
            if (twig_test_empty(($context["list_values"] ?? null))) {
                // line 30
                echo "          <p>Movie is not available.</p>
        ";
            }
            // line 32
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["list_values"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["list_value"]) {
                // line 33
                echo "          <div>
            ";
                // line 34
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = ($context["allowed_values"] ?? null)) && is_array($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) || $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 instanceof ArrayAccess ? ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4[(($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 = $context["list_value"]) && is_array($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144) || $__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144 instanceof ArrayAccess ? ($__internal_62824350bc4502ee19dbc2e99fc6bdd3bd90e7d8dd6e72f42c35efd048542144["value"] ?? null) : null)] ?? null) : null), 34, $this->source), "html", null, true);
                echo "
          </div>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['list_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "      </div>
      <hr>
    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['movie'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "modules/custom/movie/templates/start-movie-reservation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  136 => 41,  127 => 37,  118 => 34,  115 => 33,  110 => 32,  106 => 30,  103 => 29,  100 => 28,  98 => 27,  92 => 24,  88 => 23,  84 => 22,  80 => 21,  77 => 20,  73 => 19,  65 => 13,  54 => 11,  50 => 10,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<h4>Welcome to our movie reservation page</h4>

<form action=\"#\">
  <label for=\"movie-genre\">
    Please select movie genre for which you would like to make a reservation:
  </label>

  <select name=\"movie-genre\" id=\"movie-genre\">
    <option value=\"0\">All movies</option>
    {% for genre in genres %}
      <option value=\"{{ genre.id }}\">{{ genre.name }}</option>
    {% endfor %}
  </select>
  <button id=\"searchButton\" type=\"button\">Search</button>
</form>
<hr>

<div id=\"moviesByGenre\">
  {% for movie in movies %}
    <br>
    <div class=\"inactive\" id=\"movieitem-{{ movie.id }}\">
      <h5>{{ movie.label }}</h5>
      <p> Description: {{ movie.field_description.value|striptags }} </p>
      <img src=\"{{ file_url(movie.field_movie_cover_image.entity.fileuri) }}\" alt=\"\">
      <div>
        Available days:
        {% set allowed_values = movie.field_availabile_days.getSetting('allowed_values') %}
        {% set list_values = movie.field_availabile_days.getValue() %}
        {% if list_values is empty %}
          <p>Movie is not available.</p>
        {% endif %}
        {% for list_value in list_values %}
          <div>
            {{ allowed_values[list_value['value']] }}
          </div>
        {% endfor %}
      </div>
      <hr>
    </div>
  {% endfor %}
</div>
", "modules/custom/movie/templates/start-movie-reservation.html.twig", "C:\\xampp\\htdocs\\drupal_first_test\\modules\\custom\\movie\\templates\\start-movie-reservation.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 10, "set" => 27, "if" => 29);
        static $filters = array("escape" => 11, "striptags" => 23);
        static $functions = array("file_url" => 24);

        try {
            $this->sandbox->checkSecurity(
                ['for', 'set', 'if'],
                ['escape', 'striptags'],
                ['file_url']
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
