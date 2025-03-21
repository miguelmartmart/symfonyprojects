 // public/js/app.js
document.addEventListener("DOMContentLoaded", function(){
  const vehicleTypeSelect = document.getElementById("vehicleType");
  const vehicleModelSelect = document.getElementById("vehicleModel");

  function fetchVehicleModels(type) {
    fetch("/api/vehicle-models?type=" + encodeURIComponent(type))
      .then(response => response.json())
      .then(data => {
        // Limpiar opciones existentes y agregar la opción por defecto
        vehicleModelSelect.innerHTML = "<option value=\"\">Seleccione un modelo</option>";
        data.forEach(model => {
          const option = document.createElement("option");
          option.value = model.id;
          option.textContent = model.name;
          vehicleModelSelect.appendChild(option);
        });
      })
      .catch(error => console.error("Error al obtener modelos de vehículos:", error));
  }

  if (vehicleTypeSelect) {
    vehicleTypeSelect.addEventListener("change", function() {
      const selectedType = this.value;
      if (selectedType) {
        fetchVehicleModels(selectedType);
      } else {
        vehicleModelSelect.innerHTML = "<option value=\"\">Seleccione un modelo</option>";
      }
    });
  }
});
