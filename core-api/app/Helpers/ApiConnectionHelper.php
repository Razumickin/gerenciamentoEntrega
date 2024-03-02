<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class ApiConnectionHelper
{
    public static function GetApiData(string $apiUrl):stdClass
    {
        $apiData = new stdClass();

        try
        {
            $guzzleClient = new Client();
            $responseApi = $guzzleClient->get($apiUrl);
            $responseData = json_decode($responseApi->getBody());

            $apiData->data = $responseData->data;
            $apiData->code = $responseData->code;
        }
        catch (GuzzleException $exception)
        {
            $apiData->data = $exception->getMessage();
            $apiData->code = $exception->getCode();
        }

        return $apiData;
    }
}
