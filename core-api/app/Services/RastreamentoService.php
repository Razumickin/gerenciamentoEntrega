<?php

namespace App\Services;

use App\Domains\Entities\RastreamentoEntity;
use App\Models\Rastreamento;
use Illuminate\Database\Eloquent\Collection;

class RastreamentoService
{
    public function CreateRastreamento(RastreamentoEntity $rastreamentoEntity, string $entrega_id):void
    {
        $rastreamento = new Rastreamento();

        $rastreamento->mensagem = $rastreamentoEntity->mensagem;
        $rastreamento->data = $rastreamentoEntity->data;
        $rastreamento->entrega_id = $entrega_id;

        $rastreamento->save();
    }

    public function GetRastreamentosByEntregaId(string $entregaId):array
    {
        $listaRastreamentos = array();
        $rastreamentos = Rastreamento::whereEntregaId($entregaId);

        for($index = 0; $index < count($rastreamentos); $index++)
        {
            $listaRastreamentos[$index] = $this->ConvertFromCollectionToDestinatarioEntity($rastreamentos[$index]);
        }

        return $rastreamentos;
    }
}
