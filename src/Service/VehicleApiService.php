<?php
// src/Service/VehicleApiService.php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class VehicleApiService
{
    private HttpClientInterface $client;
    private string $apiUrl;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->apiUrl = 'https://www.carqueryapi.com/api/0.3/';
    }

    public function getVehicleMakes(): array
    {
        try {
            $response = $this->client->request('GET', $this->apiUrl, [
                'query' => [
                    'cmd' => 'getMakes',
                    'sold_in_us' => '1',
                    'callback' => '?'
                ]
            ]);

            $content = $response->getContent();
            $json = json_decode(trim(str_replace(['callback(', ');'], '', $content)), true);

            return $json['Makes'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getVehicleModels(string $make): array
    {
        try {
            $response = $this->client->request('GET', $this->apiUrl, [
                'query' => [
                    'cmd' => 'getModels',
                    'make' => $make,
                    'callback' => '?'
                ]
            ]);

            $content = $response->getContent();
            $json = json_decode(trim(str_replace(['callback(', ');'], '', $content)), true);

            return $json['Models'] ?? [];
        } catch (\Exception $e) {
            return [];
        }
    }
}
