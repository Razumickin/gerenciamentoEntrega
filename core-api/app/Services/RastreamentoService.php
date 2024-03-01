<?php

namespace App\Services;

use App\Domains\Entities\Rastreamento;

class RastreamentoService
{
    private Rastreamento $rastreamento;

    public function SetRastreamento(Rastreamento $rastreamento):void
    {
        $this->rastreamento = $rastreamento;
    }

    public function GetRastreamentosByEntrega():array
    {
        $rastreamentos = ['index', 'rastreamento:obj'];
        return $rastreamentos;
    }
}
