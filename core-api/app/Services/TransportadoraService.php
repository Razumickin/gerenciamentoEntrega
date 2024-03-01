<?php

namespace App\Services;

use App\Domains\Entities\Transportadora;

class TransportadoraService
{
    private Transportadora $transportadora;

    public function SetTransportadora(Transportadora $transportadora):void
    {
        $this->transportadora = $transportadora;
    }

    public function GetAllTransportadoras():array
    {
        $transportadoras = ['index', 'tranportadora:obj'];
        return $transportadoras;
    }

    public function GetTransportadoraById($id):Transportadora
    {
        return $this->transportadora;
    }
}
