<?php

namespace App\Domains\Entities;

use App\Models\Transportadora;
use stdClass;

class TransportadoraEntity
{
    public string $transportadora_id;
    public string $cnpj;
    public string $fantasia;

    public static function ConvertStdClassToEntity(stdClass $transportadora):TransportadoraEntity
    {
        $transportadoraEntity = new TransportadoraEntity();

        $transportadoraEntity->transportadora_id = $transportadora->_id;
        $transportadoraEntity->cnpj = $transportadora->_cnpj;
        $transportadoraEntity->fantasia = $transportadora->_fantasia;

        return $transportadoraEntity;
    }

    public static function ConvertModelToEntity(Transportadora $transportadora):TransportadoraEntity
    {
        $transportadoraEntity = new TransportadoraEntity();

        $transportadoraEntity->transportadora_id = $transportadora->transportadora_id;
        $transportadoraEntity->cnpj = $transportadora->cnpj;
        $transportadoraEntity->fantasia = $transportadora->nome_fantasia;

        return $transportadoraEntity;
    }
}
