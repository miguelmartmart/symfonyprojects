<?php
// src/Service/VehicleApiService.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class VehicleApiService {
    private $client;
    private $apiUrl;

    public function __construct(HttpClientInterface $client) {
        $this->client = $client;
        $this->apiUrl = $_ENV["VEHICLE_API_URL"] ?? "https://api.example.com/vehicle-models";
    }

    public function getVehicleModels(?string $type = null): array {
        $url = $this->apiUrl;
        if ($type) {
            $url .= "?type=" . urlencode($type);
        }
        $response = $this->client->request("GET", $url);
        return $response->toArray();
    }
}
