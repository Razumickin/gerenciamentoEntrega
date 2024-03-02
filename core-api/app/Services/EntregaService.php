<?php

namespace App\Services;

use App\Domains\Entities\DestinatarioEntity;
use App\Domains\Entities\EntregaEntity;
use App\Domains\Entities\RastreamentoEntity;
use App\Domains\Entities\RemetenteEntity;
use App\Domains\Entities\TransportadoraEntity;
use App\Domains\Facades\DestinatarioFacade;
use App\Domains\Facades\RastreamentoFacade;
use App\Domains\Facades\TransportadoraFacade;
use App\Helpers\ApiConnectionHelper;
use App\Models\Entrega;
use App\Models\Remetente;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class EntregaService
{
    private string $apiUrl = 'https://run.mocky.io/v3/6334edd3-ad56-427b-8f71-a3a395c5a0c7';

    public function CreateEntrega(EntregaEntity $entregaEntity):void
    {
        $entrega = new Entrega();
        $entrega->entrega_id = $entregaEntity->entrega_id;
        $entrega->volumes = $entregaEntity->volumes;
        $entrega->remetente = $entregaEntity->remetente;
        $entrega->transportadora_id = $entregaEntity->transportadora->transportadora_id;
        $entrega->destinatario_cpf = $entregaEntity->destinatario->cpf;

        $entrega->save();

        for($index = 0; $index < count($entregaEntity->rastreamentos); $index++)
        {
            RastreamentoFacade::CreateRastreamento($entregaEntity->rastreamentos[$index], $entregaEntity->entrega_id);
        }
    }

    public function GetAllEntregas():array
    {
        $this->CheckForNewEntregas();

        $listaEntregas = array();
        $entregas = Entrega::all();

        for($index = 0; $index < count($entregas); $index++)
        {
            $listaEntregas[$index] = EntregaEntity::ConvertModelToEntity($entregas[$index]);
            $listaEntregas[$index]->destinatario = DestinatarioFacade::GetDestinarioByCpf($entregas[$index]->destinatario_cpf);
            $listaEntregas[$index]->transportadora = TransportadoraFacade::GetTransportadoraByIdTransportadora($entregas[$index]->transportadora_id);
            $listaEntregas[$index]->ultimoRastreamento = RastreamentoFacade::GetRastreamentoByEntregaIdOrderByData($entregas[$index]->entrega_id);
        }

        return $listaEntregas;
    }

    public function GetEntregaByDestinarioCpf(string $destinatario_cpf):array
    {
        $listaEntregas = array();
        $entrega = Entrega::where('destinatario_cpf', '=', $destinatario_cpf)->get();

        for($index = 0; $index < count($entrega); $index++)
        {
            $listaEntregas[$index] = EntregaEntity::ConvertModelToEntity($entrega[$index]);
            $listaEntregas[$index]->destinatario = DestinatarioFacade::GetDestinarioByCpf($entrega[$index]->destinatario_cpf);
            $listaEntregas[$index]->transportadora = TransportadoraFacade::GetTransportadoraByIdTransportadora($entrega[$index]->transportadora_id);
            $listaEntregas[$index]->ultimoRastreamento = RastreamentoFacade::GetRastreamentoByEntregaIdOrderByData($entrega[$index]->entrega_id);
        }

        return $listaEntregas;
    }

    public function GetEntregaByEntregaId(string $entrega_id):?EntregaEntity
    {
        $entregaEntity = null;
        $entrega = Entrega::where('entrega_id', '=', $entrega_id)->first();

        if($entrega != null)
        {
            $entregaEntity = EntregaEntity::ConvertModelToEntity($entrega);
            $entregaEntity->destinatario = DestinatarioFacade::GetDestinarioByCpf($entrega->destinatario_cpf);
            $entregaEntity->transportadora = TransportadoraFacade::GetTransportadoraByIdTransportadora($entrega->transportadora_id);
            $entregaEntity->rastreamentos = RastreamentoFacade::GetRastreamentosByEntregaId($entrega->entrega_id);
        }

        return $entregaEntity;
    }

    private function CheckForNewEntregas()
    {
        $apiData = ApiConnectionHelper::GetApiData($this->apiUrl);

        if($apiData->code == 200)
        {
            foreach ($apiData->data as $data)
            {
                if($this->ValidateDataFromApi($data))
                {
                    $entrega = Entrega::where('entrega_id', '=', $data->_id)->first();

                    if($entrega === null)
                    {
                        $data->_transportadora = TransportadoraFacade::GetTransportadoraByIdTransportadora($data->_id_transportadora);
                        $this->CreateEntrega(EntregaEntity::ConvertStdClassToEntity($data));
                    }
                }
            }
        }
    }

    private function ValidateDataFromApi(stdClass $apiData):bool
    {
        if(empty($apiData->_id)) return false;
        if(empty($apiData->_volumes) || $apiData->_volumes < 1) return false;
        if(empty($apiData->_remetente->_nome)) return false;
        if(empty($apiData->_destinatario->_nome)) return false;
        if(empty($apiData->_destinatario->_cpf)) return false;
        if(empty($apiData->_destinatario->_endereco)) return false;
        if(empty($apiData->_destinatario->_cep)) return false;

        if(!DestinatarioFacade::CheckDestinatarioByCpf($apiData->_destinatario->_cpf))
        {
            $destinarioEntity = new DestinatarioEntity();
            $destinarioEntity = $destinarioEntity->ConvertStdClassToEntity($apiData->_destinatario);

            DestinatarioFacade::CreateDestinario($destinarioEntity);
        }

        if(!TransportadoraFacade::CheckTransportadoraByTransportadoraId($apiData->_id_transportadora)) return false;

        return true;
    }
}
