<?php
// src/Controller/ApiController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Service\VehicleApiService;

class ApiController extends AbstractController {
    /**
     * @Route("/api/vehicle-models", name="api_vehicle_models", methods={"GET"})
     */
    public function getVehicleModels(Request $request, VehicleApiService $vehicleApiService): JsonResponse {
        $vehicleType = $request->query->get("type", null);
        $models = $vehicleApiService->getVehicleModels($vehicleType);
        return new JsonResponse($models);
    }
}
