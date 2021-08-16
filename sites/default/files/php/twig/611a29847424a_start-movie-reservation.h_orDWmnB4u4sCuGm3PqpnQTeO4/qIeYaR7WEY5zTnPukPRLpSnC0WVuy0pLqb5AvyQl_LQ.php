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

/* modules/custom/controller/templates/start-movie-reservation.html.twig */
class __TwigTemplate_b4c92093f1c9a5d41ba59eac10fc30923d6b0e151468f3f34baed549f3a41f19 extends \Twig\Template
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
    ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["genres"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["genre"]) {
            // line 10
            echo "      <option value=\"";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["genre"], "id", [], "any", false, false, true, 10), 10, $this->source), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["genre"], "name", [], "any", false, false, true, 10), 10, $this->source), "html", null, true);
            echo "</option>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['genre'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "  </select>
  <button type=\"button\" onclick=\"getMoviesByGenre()\">Search</button>
</form>

<div id=\"moviesByGenre\">

</div>


<style>
  .active {
    background-color: #285c91;
  }

  .inactive {
    background-color: white;
  }

</style>
<script>
  function getMoviesByGenre() {
    var genre = document.getElementById('movie-genre').value;
    console.log(genre);

    jQuery.ajax({
      url: \"/getMoviesByGenre\",
      type: \"get\",
      data: {\"genre\": genre},
      success: function (response) {
        populateHtml(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  }

  function populateHtml(data) {
    let html = \"\";

    jQuery.each(data, function (k, v) {

      if (v.days_available == null) {
        v.days_available = 'Not available.'
      }

      let days_available_built = ''
      for (let key in v.days_available){ days_available_built += v.days_available[key] + ' ' }

      html += `<br><div class=\"inactive\" id=\"movie-\${v.id}\" onclick=\"toggleActive(this.id)\" \"> <h4>Title: \${v.title} </h4> <br> <img src=\"\${v.image}\"> <p>Description: \${v.description} </p> <p> Available days:` + days_available_built + `</p></div><hr>`
    })

    jQuery('#moviesByGenre').html(html);
  }

  function toggleActive(id) {
    var clickedDiv = document.getElementById(id)

    if (clickedDiv.className == \"inactive\") {

      var alreadyActive = document.getElementsByClassName(\"active\");
      console.log(alreadyActive[0])

      // Deactivate another active divs if exist
      for (let i = 0; i < alreadyActive.length; i++) {
        if (typeof alreadyActive[i] !== \"undefined\" && alreadyActive[i].id != clickedDiv.id) {
          alreadyActive[i].className = \"inactive\"
          jQuery('#reservationButton').remove()
        }
      }

      clickedDiv.className = \"active\"
      alreadyActive = []
      jQuery('#'+id).after(`<div id=\"reservationButton\"><button>Reserve movie</button></div>`)

    } else {
      clickedDiv.className = \"inactive\"
      jQuery('#reservationButton').remove()
    }
  }
</script>
";
    }

    public function getTemplateName()
    {
        return "modules/custom/controller/templates/start-movie-reservation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 12,  53 => 10,  49 => 9,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<h4>Welcome to our movie reservation page</h4>

<form action=\"#\">
  <label for=\"movie-genre\">
    Please select movie genre for which you would like to make a reservation:
  </label>

  <select name=\"movie-genre\" id=\"movie-genre\">
    {% for genre in genres %}
      <option value=\"{{ genre.id }}\">{{ genre.name }}</option>
    {% endfor %}
  </select>
  <button type=\"button\" onclick=\"getMoviesByGenre()\">Search</button>
</form>

<div id=\"moviesByGenre\">

</div>


<style>
  .active {
    background-color: #285c91;
  }

  .inactive {
    background-color: white;
  }

</style>
<script>
  function getMoviesByGenre() {
    var genre = document.getElementById('movie-genre').value;
    console.log(genre);

    jQuery.ajax({
      url: \"/getMoviesByGenre\",
      type: \"get\",
      data: {\"genre\": genre},
      success: function (response) {
        populateHtml(response);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  }

  function populateHtml(data) {
    let html = \"\";

    jQuery.each(data, function (k, v) {

      if (v.days_available == null) {
        v.days_available = 'Not available.'
      }

      let days_available_built = ''
      for (let key in v.days_available){ days_available_built += v.days_available[key] + ' ' }

      html += `<br><div class=\"inactive\" id=\"movie-\${v.id}\" onclick=\"toggleActive(this.id)\" \"> <h4>Title: \${v.title} </h4> <br> <img src=\"\${v.image}\"> <p>Description: \${v.description} </p> <p> Available days:` + days_available_built + `</p></div><hr>`
    })

    jQuery('#moviesByGenre').html(html);
  }

  function toggleActive(id) {
    var clickedDiv = document.getElementById(id)

    if (clickedDiv.className == \"inactive\") {

      var alreadyActive = document.getElementsByClassName(\"active\");
      console.log(alreadyActive[0])

      // Deactivate another active divs if exist
      for (let i = 0; i < alreadyActive.length; i++) {
        if (typeof alreadyActive[i] !== \"undefined\" && alreadyActive[i].id != clickedDiv.id) {
          alreadyActive[i].className = \"inactive\"
          jQuery('#reservationButton').remove()
        }
      }

      clickedDiv.className = \"active\"
      alreadyActive = []
      jQuery('#'+id).after(`<div id=\"reservationButton\"><button>Reserve movie</button></div>`)

    } else {
      clickedDiv.className = \"inactive\"
      jQuery('#reservationButton').remove()
    }
  }
</script>
", "modules/custom/controller/templates/start-movie-reservation.html.twig", "C:\\xampp\\htdocs\\drupal_first_test\\modules\\custom\\controller\\templates\\start-movie-reservation.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 9);
        static $filters = array("escape" => 10);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['escape'],
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
