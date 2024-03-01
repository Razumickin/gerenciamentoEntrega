<?php

namespace App\Services;

use App\Domains\Entities\Destinatario;
use App\Domains\Entities\Entrega;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class EntregaService
{
    private Entrega $entrega;
    private string $apiUrl = 'https://run.mocky.io/v3/6334edd3-ad56-427b-8f71-a3a395c5a0c7';

    public function SetEntrega(Entrega $entrega):void
    {
        $this->entrega = $entrega;
    }

    public function GetAllEntregas():array
    {
        return $this->GetAllEntregasFromApi();
    }

    public function GetEntregaByDestinarioCpf(Destinatario $destinatario):Entrega
    {
        return $this->entrega;
    }

    private function GetAllEntregasFromApi(): array
    {
        try
        {
            $guzzleClient = new Client();

            $responseApi = $guzzleClient->get($this->apiUrl);
            $apiData = json_decode($responseApi->getBody());

            $response = $apiData->data;
        }
        catch (GuzzleException $exception)
        {
            $response = $exception->getMessage();
        }

        return $response;
    }
}
