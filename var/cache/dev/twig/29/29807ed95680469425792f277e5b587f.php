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

        // line 2
        yield "<!DOCTYPE html>
<html lang=\"es\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <title>Gestión de Citas - Taller de Vehículos</title>
  <link rel=\"stylesheet\" href=\"/css/styles.css\">
</head>
<body>
  <header>
    <h1>Gestión de Citas - Taller de Vehículos</h1>
  </header>
  <main>
    <section id=\"appointments\">
      <h2>Citas Programadas</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha y Hora</th>
            <th>Tipo de Vehículo</th>
            <th>Modelo</th>
            <th>Tipo de Reparación</th>
            <th>Tiempo Estimado</th>
          </tr>
        </thead>
        <tbody>
          ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["appointments"]) || array_key_exists("appointments", $context) ? $context["appointments"] : (function () { throw new RuntimeError('Variable "appointments" does not exist.', 30, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["appointment"]) {
            // line 31
            yield "            <tr>
              <td>";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "id", [], "any", false, false, false, 32), "html", null, true);
            yield "</td>
              <td>";
            // line 33
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "customerName", [], "any", false, false, false, 33), "html", null, true);
            yield "</td>
              <td>";
            // line 34
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "appointmentDate", [], "any", false, false, false, 34), "Y-m-d H:i"), "html", null, true);
            yield "</td>
              <td>";
            // line 35
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "vehicleType", [], "any", false, false, false, 35), "html", null, true);
            yield "</td>
              <td>";
            // line 36
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "vehicleModel", [], "any", false, false, false, 36), "html", null, true);
            yield "</td>
              <td>";
            // line 37
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "repairType", [], "any", false, false, false, 37), "html", null, true);
            yield "</td>
              <td>";
            // line 38
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["appointment"], "estimatedRepairTime", [], "any", false, false, false, 38), "html", null, true);
            yield " min</td>
            </tr>
          ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['appointment'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        yield "        </tbody>
      </table>
    </section>
    <section id=\"new-appointment\">
      <h2>Nueva Cita</h2>
      <form id=\"appointmentForm\" method=\"POST\" action=\"/appointments/create\">
        <input type=\"text\" name=\"customerName\" placeholder=\"Nombre del Cliente\" required>
        <input type=\"datetime-local\" name=\"appointmentDate\" required>
        
        <label for=\"vehicleType\">Tipo de Vehículo</label>
        <select name=\"vehicleType\" id=\"vehicleType\" required>
          <option value=\"\">Seleccione un tipo</option>
          <option value=\"car\">Automóvil</option>
          <option value=\"motorcycle\">Motocicleta</option>
          <option value=\"other\">Otro</option>
        </select>
        
        <label for=\"vehicleModel\">Modelo del Vehículo</label>
        <select name=\"vehicleModel\" id=\"vehicleModel\" required>
          <option value=\"\">Seleccione un modelo</option>
          <!-- Opciones se rellenarán dinámicamente mediante JavaScript -->
        </select>
        
        <input type=\"text\" name=\"repairType\" placeholder=\"Tipo de Reparación\" required>
        <input type=\"number\" name=\"estimatedRepairTime\" placeholder=\"Tiempo Estimado (min)\" required>
        <button type=\"submit\">Registrar Cita</button>
      </form>
    </section>
  </main>
  <script src=\"/js/app.js\"></script>
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
        return array (  115 => 41,  106 => 38,  102 => 37,  98 => 36,  94 => 35,  90 => 34,  86 => 33,  82 => 32,  79 => 31,  75 => 30,  45 => 2,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{# templates/appointments/list.html.twig #}
<!DOCTYPE html>
<html lang=\"es\">
<head>
  <meta charset=\"UTF-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
  <title>Gestión de Citas - Taller de Vehículos</title>
  <link rel=\"stylesheet\" href=\"/css/styles.css\">
</head>
<body>
  <header>
    <h1>Gestión de Citas - Taller de Vehículos</h1>
  </header>
  <main>
    <section id=\"appointments\">
      <h2>Citas Programadas</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha y Hora</th>
            <th>Tipo de Vehículo</th>
            <th>Modelo</th>
            <th>Tipo de Reparación</th>
            <th>Tiempo Estimado</th>
          </tr>
        </thead>
        <tbody>
          {% for appointment in appointments %}
            <tr>
              <td>{{ appointment.id }}</td>
              <td>{{ appointment.customerName }}</td>
              <td>{{ appointment.appointmentDate|date(\"Y-m-d H:i\") }}</td>
              <td>{{ appointment.vehicleType }}</td>
              <td>{{ appointment.vehicleModel }}</td>
              <td>{{ appointment.repairType }}</td>
              <td>{{ appointment.estimatedRepairTime }} min</td>
            </tr>
          {% endfor %}
        </tbody>
      </table>
    </section>
    <section id=\"new-appointment\">
      <h2>Nueva Cita</h2>
      <form id=\"appointmentForm\" method=\"POST\" action=\"/appointments/create\">
        <input type=\"text\" name=\"customerName\" placeholder=\"Nombre del Cliente\" required>
        <input type=\"datetime-local\" name=\"appointmentDate\" required>
        
        <label for=\"vehicleType\">Tipo de Vehículo</label>
        <select name=\"vehicleType\" id=\"vehicleType\" required>
          <option value=\"\">Seleccione un tipo</option>
          <option value=\"car\">Automóvil</option>
          <option value=\"motorcycle\">Motocicleta</option>
          <option value=\"other\">Otro</option>
        </select>
        
        <label for=\"vehicleModel\">Modelo del Vehículo</label>
        <select name=\"vehicleModel\" id=\"vehicleModel\" required>
          <option value=\"\">Seleccione un modelo</option>
          <!-- Opciones se rellenarán dinámicamente mediante JavaScript -->
        </select>
        
        <input type=\"text\" name=\"repairType\" placeholder=\"Tipo de Reparación\" required>
        <input type=\"number\" name=\"estimatedRepairTime\" placeholder=\"Tiempo Estimado (min)\" required>
        <button type=\"submit\">Registrar Cita</button>
      </form>
    </section>
  </main>
  <script src=\"/js/app.js\"></script>
</body>
</html>
", "appointments/list.html.twig", "/var/www/html/templates/appointments/list.html.twig");
    }
}
