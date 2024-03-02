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

    public function GetRastreamentoByEntregaIdOrderByData(string $entrega_id):RastreamentoEntity
    {
        $ultimoRastreamento = Rastreamento::where('entrega_id', '=', $entrega_id)->orderBy('data', 'desc')->first();
        $rastreamento = RastreamentoEntity::ConvertModelToEntity($ultimoRastreamento);

        return $rastreamento;
    }

    public function GetRastreamentosByEntregaId(string $entrega_id):array
    {
        $listaRastreamentos = array();
        $rastramentos = Rastreamento::where('entrega_id', '=', $entrega_id)->orderBy('data', 'asc')->get();

        for($index = 0; $index < count($rastramentos); $index++)
        {
            $listaRastreamentos[$index] = RastreamentoEntity::ConvertModelToEntity($rastramentos[$index]);
        }

        return $listaRastreamentos;
    }
}
