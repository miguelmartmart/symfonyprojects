<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class VehicleApiService {
    private $client;
    private $apiUrl;

    public function __construct(HttpClientInterface $client) {
        $this->client = $client;
        // URL base definida en .env
        $this->apiUrl = $_ENV['VEHICLE_API_URL'] ?? 'https://www.carqueryapi.com/api/0.3/';
    }

    // Obtiene los modelos para una marca dada
    public function getVehicleModels(?string $make = null): array {
        $url = $this->apiUrl . "?cmd=getModels";
        if ($make) {
            $url .= "&make=" . urlencode($make);
        }
        
        // Agregar headers personalizados para simular una petición de navegador
        $options = [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36',
                'Accept' => 'application/json',
                'Referer' => 'http://localhost:8000'
            ]
        ];
        
        $response = $this->client->request('GET', $url, $options);
        $data = $response->toArray();

        // CarQuery API devuelve los modelos en la clave 'Models'
        return $data['Models'] ?? [];
    }

    // Método para obtener las marcas (makes)
    public function getVehicleMakes(): array {
        $url = $this->apiUrl . "?cmd=getMakes";
        
        $options = [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'Accept' => 'application/json',
                'Referer' => 'http://localhost:8000'
            ]
        ];
        
        $response = $this->client->request('GET', $url, $options);
        $data = $response->toArray();
        return $data['Makes'] ?? [];
    }
}
