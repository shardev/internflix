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

/* themes/contrib/danland/templates/links.html.twig */
class __TwigTemplate_58e77d3a33bbad308a61294d829b1b45220d22b94be98a1b66b81a7f7a75e25a extends \Twig\Template
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
        // line 35
        if (($context["links"] ?? null)) {
            // line 36
            if (($context["heading"] ?? null)) {
                // line 37
                if (twig_get_attribute($this->env, $this->source, ($context["heading"] ?? null), "level", [], "any", false, false, true, 37)) {
                    // line 38
                    echo "<";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["heading"] ?? null), "level", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["heading"] ?? null), "attributes", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
                    echo ">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["heading"] ?? null), "text", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
                    echo "</";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["heading"] ?? null), "level", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
                    echo ">";
                } else {
                    // line 40
                    echo "<h2";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["heading"] ?? null), "attributes", [], "any", false, false, true, 40), 40, $this->source), "html", null, true);
                    echo ">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["heading"] ?? null), "text", [], "any", false, false, true, 40), 40, $this->source), "html", null, true);
                    echo "</h2>";
                }
            }
            // line 43
            echo "<div class=\"links\">
  <ul";
            // line 44
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 44, $this->source), "html", null, true);
            echo ">";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["links"] ?? null));
            foreach ($context['_seq'] as $context["key"] => $context["item"]) {
                // line 46
                echo "<li";
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "attributes", [], "any", false, false, true, 46), "addClass", [0 => \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed($context["key"], 46, $this->source))], "method", false, false, true, 46), 46, $this->source), "html", null, true);
                echo ">";
                // line 47
                if (twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, true, 47)) {
                    // line 48
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, true, 48), 48, $this->source), "html", null, true);
                } elseif (twig_get_attribute($this->env, $this->source,                 // line 49
$context["item"], "text_attributes", [], "any", false, false, true, 49)) {
                    // line 50
                    echo "<span";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "text_attributes", [], "any", false, false, true, 50), 50, $this->source), "html", null, true);
                    echo ">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, true, 50), 50, $this->source), "html", null, true);
                    echo "</span>";
                } else {
                    // line 52
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, true, 52), 52, $this->source), "html", null, true);
                }
                // line 54
                echo "</li>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            echo "</ul>
  </div>";
        }
    }

    public function getTemplateName()
    {
        return "themes/contrib/danland/templates/links.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 56,  93 => 54,  90 => 52,  83 => 50,  81 => 49,  79 => 48,  77 => 47,  73 => 46,  69 => 45,  66 => 44,  63 => 43,  55 => 40,  45 => 38,  43 => 37,  41 => 36,  39 => 35,);
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Theme override for a set of links.
 *
 * Available variables:
 * - attributes: Attributes for the UL containing the list of links.
 * - links: Links to be output.
 *   Each link will have the following elements:
 *   - title: The link text.
 *   - href: The link URL. If omitted, the 'title' is shown as a plain text
 *     item in the links list. If 'href' is supplied, the entire link is passed
 *     to l() as its \$options parameter.
 *   - attributes: (optional) HTML attributes for the anchor, or for the <span>
 *     tag if no 'href' is supplied.
 *   - link_key: The link CSS class.
 * - heading: (optional) A heading to precede the links.
 *   - text: The heading text.
 *   - level: The heading level (e.g. 'h2', 'h3').
 *   - attributes: (optional) A keyed list of attributes for the heading.
 *   If the heading is a string, it will be used as the text of the heading and
 *   the level will default to 'h2'.
 *
 *   Headings should be used on navigation menus and any list of links that
 *   consistently appears on multiple pages. To make the heading invisible use
 *   the 'visually-hidden' CSS class. Do not use 'display:none', which
 *   removes it from screen readers and assistive technology. Headings allow
 *   screen reader and keyboard only users to navigate to or skip the links.
 *   See http://juicystudio.com/article/screen-readers-display-none.php and
 *   http://www.w3.org/TR/WCAG-TECHS/H42.html for more information.
 *
 * @see template_preprocess_links()
 */
#}
{% if links -%}
  {%- if heading -%}
    {%- if heading.level -%}
      <{{ heading.level }}{{ heading.attributes }}>{{ heading.text }}</{{ heading.level }}>
    {%- else -%}
      <h2{{ heading.attributes }}>{{ heading.text }}</h2>
    {%- endif -%}
  {%- endif -%}
  <div class=\"links\">
  <ul{{ attributes }}>
    {%- for key, item in links -%}
      <li{{ item.attributes.addClass(key|clean_class) }}>
        {%- if item.link -%}
          {{ item.link }}
        {%- elseif item.text_attributes -%}
          <span{{ item.text_attributes }}>{{ item.text }}</span>
        {%- else -%}
          {{ item.text }}
        {%- endif -%}
      </li>
    {%- endfor -%}
  </ul>
  </div>
{%- endif %}
", "themes/contrib/danland/templates/links.html.twig", "C:\\xampp\\htdocs\\drupal_first_test\\themes\\contrib\\danland\\templates\\links.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("if" => 35, "for" => 45);
        static $filters = array("escape" => 38, "clean_class" => 46);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['if', 'for'],
                ['escape', 'clean_class'],
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
