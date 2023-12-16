<?php

namespace App\Interfaces\ClientService;

interface ClientServiceInterface
{
    public function request(string $method, string $url, array $params);
    public function storeUsers();
    public function storeCompanies();
    public function storePositions();
    public function getHeaders(): array;
    public function setHeaders(): array;
}
