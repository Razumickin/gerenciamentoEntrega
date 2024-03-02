<?php

namespace App\Domains\Entities;

use App\Models\Rastreamento;
use stdClass;

class RastreamentoEntity
{
    public string $mensagem;
    public string $data;

    public static function ConvertStdClassToEntity(stdClass $rastreamento):RastreamentoEntity
    {
        $rastreamentoEntity = new RastreamentoEntity();

        $rastreamentoEntity->mensagem = $rastreamento->message;
        $rastreamentoEntity->data = date('Y-m-d h:i:s', strtotime($rastreamento->date));;

        return $rastreamentoEntity;
    }

    public static function ConvertModelToEntity(Rastreamento $rastreamento):RastreamentoEntity
    {
        $rastreamentoEntity = new RastreamentoEntity();

        $rastreamentoEntity->mensagem = $rastreamento->mensagem;
        $rastreamentoEntity->data = date('d/m/Y h:i:s', strtotime($rastreamento->data));

        return $rastreamentoEntity;
    }
}
