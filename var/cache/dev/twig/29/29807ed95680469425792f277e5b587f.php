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

/* appointments/list.html.twig */
class __TwigTemplate_a3f5828eedab0674b27c32b2bad1793c extends Template
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
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "appointments/list.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"es\">
<head>
    <meta charset=\"UTF-8\">
    <title>Gestión de Citas - Taller de Vehículos</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <!-- Incluir Bootstrap para responsividad -->
    <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css\">
    <link rel=\"stylesheet\" href=\"/css/styles.css\">
</head>
<body>
    <div class=\"container my-4\">
        <h1 class=\"text-center\">Gestión de Citas - Taller de Vehículos</h1>
        <div class=\"row my-3\">
            <div class=\"col-md-4\">
                <label for=\"vehicleType\" class=\"form-label\">Tipo de Vehículo</label>
                <select id=\"vehicleType\" name=\"vehicleType\" class=\"form-select\">
                    <option value=\"\">Seleccione un tipo</option>
                    ";
        // line 19
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["vehicleTypes"]) || array_key_exists("vehicleTypes", $context) ? $context["vehicleTypes"] : (function () { throw new RuntimeError('Variable "vehicleTypes" does not exist.', 19, $this->source); })()));
        foreach ($context['_seq'] as $context["key"] => $context["label"]) {
            // line 20
            yield "                        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["key"], "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
            yield "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['key'], $context['label'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        yield "                </select>
            </div>
            <div class=\"col-md-4\">
                <label for=\"vehicleMake\" class=\"form-label\">Marca</label>
                <select id=\"vehicleMake\" name=\"vehicleMake\" class=\"form-select\">
                    <option value=\"\">Seleccione una marca</option>
                    ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["makes"]) || array_key_exists("makes", $context) ? $context["makes"] : (function () { throw new RuntimeError('Variable "makes" does not exist.', 28, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["make"]) {
            // line 29
            yield "                        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["make"], "make_id", [], "any", false, false, false, 29), "html", null, true);
            yield "\" ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["make"], "make_id", [], "any", false, false, false, 29) == (isset($context["defaultMake"]) || array_key_exists("defaultMake", $context) ? $context["defaultMake"] : (function () { throw new RuntimeError('Variable "defaultMake" does not exist.', 29, $this->source); })()))) {
                yield "selected";
            }
            yield ">
                            ";
            // line 30
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["make"], "make_display", [], "any", false, false, false, 30), "html", null, true);
            yield "
                        </option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['make'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 33
        yield "                </select>
            </div>
            <div class=\"col-md-4\">
                <label for=\"vehicleModel\" class=\"form-label\">Modelo</label>
                <select id=\"vehicleModel\" name=\"vehicleModel\" class=\"form-select\">
                    <option value=\"\">Seleccione un modelo</option>
                    ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["models"]) || array_key_exists("models", $context) ? $context["models"] : (function () { throw new RuntimeError('Variable "models" does not exist.', 39, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["model"]) {
            // line 40
            yield "                        <option value=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["model"], "model_name", [], "any", false, false, false, 40), "html", null, true);
            yield "\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["model"], "model_name", [], "any", false, false, false, 40), "html", null, true);
            yield "</option>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['model'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        yield "                </select>
            </div>
        </div>
        <!-- Aquí puedes agregar el listado de citas o formularios adicionales -->
    </div>

    <!-- Incluir Bootstrap JS -->
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\"></script>
    <script>
      // Actualiza el desplegable de modelos cuando cambie la marca
      document.getElementById('vehicleMake').addEventListener('change', function() {
          const make = this.value;
          fetch('/api/vehicle-models?make=' + encodeURIComponent(make))
            .then(response => response.json())
            .then(data => {
                const modelSelect = document.getElementById('vehicleModel');
                modelSelect.innerHTML = '<option value=\"\">Seleccione un modelo</option>';
                data.forEach(model => {
                    const option = document.createElement('option');
                    option.value = model.model_name;
                    option.textContent = model.model_name;
                    modelSelect.appendChild(option);
                });
            })
            .catch(error => console.error(\"Error al cargar modelos:\", error));
      });
    </script>
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
        return "appointments/list.html.twig";
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
        return array (  133 => 42,  122 => 40,  118 => 39,  110 => 33,  101 => 30,  92 => 29,  88 => 28,  80 => 22,  69 => 20,  65 => 19,  45 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"es\">
<head>
    <meta charset=\"UTF-8\">
    <title>Gestión de Citas - Taller de Vehículos</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <!-- Incluir Bootstrap para responsividad -->
    <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css\">
    <link rel=\"stylesheet\" href=\"/css/styles.css\">
</head>
<body>
    <div class=\"container my-4\">
        <h1 class=\"text-center\">Gestión de Citas - Taller de Vehículos</h1>
        <div class=\"row my-3\">
            <div class=\"col-md-4\">
                <label for=\"vehicleType\" class=\"form-label\">Tipo de Vehículo</label>
                <select id=\"vehicleType\" name=\"vehicleType\" class=\"form-select\">
                    <option value=\"\">Seleccione un tipo</option>
                    {% for key, label in vehicleTypes %}
                        <option value=\"{{ key }}\">{{ label }}</option>
                    {% endfor %}
                </select>
            </div>
            <div class=\"col-md-4\">
                <label for=\"vehicleMake\" class=\"form-label\">Marca</label>
                <select id=\"vehicleMake\" name=\"vehicleMake\" class=\"form-select\">
                    <option value=\"\">Seleccione una marca</option>
                    {% for make in makes %}
                        <option value=\"{{ make.make_id }}\" {% if make.make_id == defaultMake %}selected{% endif %}>
                            {{ make.make_display }}
                        </option>
                    {% endfor %}
                </select>
            </div>
            <div class=\"col-md-4\">
                <label for=\"vehicleModel\" class=\"form-label\">Modelo</label>
                <select id=\"vehicleModel\" name=\"vehicleModel\" class=\"form-select\">
                    <option value=\"\">Seleccione un modelo</option>
                    {% for model in models %}
                        <option value=\"{{ model.model_name }}\">{{ model.model_name }}</option>
                    {% endfor %}
                </select>
            </div>
        </div>
        <!-- Aquí puedes agregar el listado de citas o formularios adicionales -->
    </div>

    <!-- Incluir Bootstrap JS -->
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js\"></script>
    <script>
      // Actualiza el desplegable de modelos cuando cambie la marca
      document.getElementById('vehicleMake').addEventListener('change', function() {
          const make = this.value;
          fetch('/api/vehicle-models?make=' + encodeURIComponent(make))
            .then(response => response.json())
            .then(data => {
                const modelSelect = document.getElementById('vehicleModel');
                modelSelect.innerHTML = '<option value=\"\">Seleccione un modelo</option>';
                data.forEach(model => {
                    const option = document.createElement('option');
                    option.value = model.model_name;
                    option.textContent = model.model_name;
                    modelSelect.appendChild(option);
                });
            })
            .catch(error => console.error(\"Error al cargar modelos:\", error));
      });
    </script>
</body>
</html>
", "appointments/list.html.twig", "/var/www/html/templates/appointments/list.html.twig");
    }
}
