<?php

namespace App\Services;

use App\Interfaces\ClientService\ClientServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

abstract class AbstractClientService implements ClientServiceInterface
{
    abstract public function storeUsers();
    abstract public function storeCompanies();
    abstract public function storePositions();
    abstract public function getHeaders(): array;
    abstract public function setHeaders(): array;

    public function request(string $method, string $url, array $params)
    {
        try {
            $client = new Client(['base_uri' => $url]);
            $response = $client->request($method, $url, $params);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $exception) {
           Log::error($exception->getMessage());

            return false;
        }
    }
}
