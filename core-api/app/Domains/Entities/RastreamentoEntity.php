<?php

namespace App\Domains\Entities;

use stdClass;

class RastreamentoEntity
{
    public string $entregaId;
    public string $mensagem;
    public string $data;

    public static function ConvertToEntity(stdClass $rastreamento):RastreamentoEntity
    {
        $rastreamentoEntity = new RastreamentoEntity();

        $rastreamentoEntity->mensagem = $rastreamento->message;
        $rastreamentoEntity->data = date('Y-m-d h:i:s', strtotime($rastreamento->date));;

        return $rastreamentoEntity;
    }
}
