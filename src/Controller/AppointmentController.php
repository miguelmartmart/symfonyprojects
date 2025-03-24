<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\VehicleApiService;

class AppointmentController extends AbstractController {
    #[Route('/appointments', name: 'appointments', methods: ['GET'])]
    public function list(VehicleApiService $vehicleApiService): Response {
        // Definir tipos de vehículo fijos
        $vehicleTypes = [
            'car' => 'Automóvil',
            'motorcycle' => 'Motocicleta',
            'other' => 'Otro'
        ];
        
        // Obtener la lista de marcas (makes)
        $makes = $vehicleApiService->getVehicleMakes();
        
        // Seleccionar una marca por defecto (por ejemplo, la primera)
        $defaultMake = !empty($makes) ? ($makes[0]['make_id'] ?? null) : null;
        
        // Obtener modelos para la marca por defecto
        $models = $defaultMake ? $vehicleApiService->getVehicleModels($defaultMake) : [];
        
        return $this->render('appointments/list.html.twig', [
            'appointments' => [], // Si tienes citas, pásalas aquí
            'vehicleTypes' => $vehicleTypes,
            'makes' => $makes,
            'defaultMake' => $defaultMake,
            'models' => $models
        ]);
    }
}
