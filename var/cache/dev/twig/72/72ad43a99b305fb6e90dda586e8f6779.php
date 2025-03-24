<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* default/index.html.twig */
class __TwigTemplate_9d8c6a57fcfa958568513f82719337d3 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "default/index.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"es\">
    <head>
        <meta charset=\"UTF-8\">
        <title>Página de Inicio</title>
        <style>
          /* Estilos básicos para que el enlace se vea como botón */
          .btn {
              display: inline-block;
              padding: 0.5em 1em;
              background-color: #007bff;
              color: white;
              text-decoration: none;
              border-radius: 4px;
              font-size: 1rem;
          }
          .btn:hover {
              background-color: #0056b3;
          }
        </style>
    </head>
<body>
    <h1>";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["message"]) || array_key_exists("message", $context) ? $context["message"] : (function () { throw new RuntimeError('Variable "message" does not exist.', 23, $this->source); })()), "html", null, true);
        yield "</h1>
    <!-- Botón que redirige a la ruta 'appointments' -->
    <a href=\"";
        // line 25
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("appointments");
        yield "\" class=\"btn\">Ver Citas</a>
</body>
</html>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "default/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  74 => 25,  69 => 23,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"es\">
    <head>
        <meta charset=\"UTF-8\">
        <title>Página de Inicio</title>
        <style>
          /* Estilos básicos para que el enlace se vea como botón */
          .btn {
              display: inline-block;
              padding: 0.5em 1em;
              background-color: #007bff;
              color: white;
              text-decoration: none;
              border-radius: 4px;
              font-size: 1rem;
          }
          .btn:hover {
              background-color: #0056b3;
          }
        </style>
    </head>
<body>
    <h1>{{ message }}</h1>
    <!-- Botón que redirige a la ruta 'appointments' -->
    <a href=\"{{ path('appointments') }}\" class=\"btn\">Ver Citas</a>
</body>
</html>
", "default/index.html.twig", "/var/www/html/templates/default/index.html.twig");
    }
}
