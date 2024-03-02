<?php

namespace App\Services;

use App\Domains\Entities\EntregaEntity;
use App\Domains\Entities\TransportadoraEntity;
use App\Helpers\ApiConnectionHelper;
use App\Models\Transportadora;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use stdClass;

class TransportadoraService
{
    private TransportadoraEntity $transportadora;

    private string $apiUrl = 'https://run.mocky.io/v3/e8032a9d-7c4b-4044-9d00-57733a2e2637';

    public function CreateTransportadora(TransportadoraEntity $transportadora):void
    {
        $Transportadora = new Transportadora();

        $Transportadora->transportadora_id = $transportadora->transportadora_id;
        $Transportadora->cnpj = $transportadora->cnpj;
        $Transportadora->nome_fantasia = $transportadora->fantasia;

        $Transportadora->save();
    }

    public function GetAllTransportadoras():array
    {
        $transportadoras = ['index', 'tranportadora:obj'];
        return $transportadoras;
    }

    public function GetTransportadoraByIdTransportadora(string $tranportadora_id):TransportadoraEntity
    {
        $Transportadora = Transportadora::where('transportadora_id', '=',$tranportadora_id)->first();
        return TransportadoraEntity::ConvertModelToEntity($Transportadora);
    }

    public function CheckTransportadoraByTransportadoraId(string $transportadora_id):bool
    {
        $apiData = ApiConnectionHelper::GetApiData($this->apiUrl);

        if($apiData->code == 200)
        {
            foreach ($apiData->data as $data)
            {
                if($this->ValidateDataFromApi($data))
                {
                    $transportadora = Transportadora::where('transportadora_id', '=', $data->_id)->first();

                    if($transportadora === null)
                    {
                        $this->CreateTransportadora(TransportadoraEntity::ConvertStdClassToEntity($data));
                    }
                }
            }
        }

        $transportadora = Transportadora::where('transportadora_id', '=', $transportadora_id)->first();

        if($transportadora === null)
        {
            return false;
        }

        return true;
    }

    private function ValidateDataFromApi(stdClass $apiData):bool
    {
        if(empty($apiData->_id)) return false;
        if(empty($apiData->_cnpj)) return false;
        if(empty($apiData->_fantasia)) return false;

        return true;
    }
}
