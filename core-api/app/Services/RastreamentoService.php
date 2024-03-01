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
}
