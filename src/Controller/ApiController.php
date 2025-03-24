<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\VehicleApiService;

class ApiController extends AbstractController {
    #[Route('/api/vehicle-models', name: 'api_vehicle_models', methods: ['GET'])]
    public function getVehicleModels(Request $request, VehicleApiService $vehicleApiService): JsonResponse {
        // Ahora leemos el parámetro 'make'
        $make = $request->query->get('make', null);
        $models = $vehicleApiService->getVehicleModels($make);
        return new JsonResponse($models);
    }
}
